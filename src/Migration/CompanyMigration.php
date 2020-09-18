<?php

namespace Heartbits\ContaoContacts\Migration;

use Contao\CoreBundle\Migration\AbstractMigration;
use Contao\CoreBundle\Migration\MigrationResult;
use Doctrine\DBAL\Connection;

class CompanyMigration extends AbstractMigration
{
    /**
     * @var Connection
     */
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function shouldRun(): bool
    {
        $schemaManager = $this->connection->getSchemaManager();

        // If the database table itself does not exist we should do nothing
        if (!$schemaManager->tablesExist(['tl_companies'])) {
            return false;
        }

        $columns = $schemaManager->listTableColumns('tl_companies');

        return
            isset($columns['geocoderAddress']) &&
            isset($columns['geocoderCountry']) &&
            !isset($columns['street']) &&
            !isset($columns['zip']) &&
            !isset($columns['city']) &&
            !isset($columns['country']);
    }

    public function run(): MigrationResult
    {
        $this->connection->query('ALTER TABLE tl_companies ADD street varchar(255) NOT NULL default ""');
        $this->connection->query('ALTER TABLE tl_companies ADD zip CHAR(5) NOT NULL default ""');
        $this->connection->query('ALTER TABLE tl_companies ADD city varchar(255) NOT NULL default ""');
        $this->connection->query('ALTER TABLE tl_companies ADD country varchar(2) NOT NULL default "de"');

        // Set old company as new pid
        $this->connection->prepare('UPDATE tl_companies SET country = geocoderCountry')->execute();

        // Get all companies and split the addresses into the corresponding fields
        $companies = $this->connection->fetchAll('SELECT id,geocoderAddress FROM tl_companies');
        foreach ($companies as $company) {
            $street = '';
            $zip = '';
            $city = '';
            $arrAddress = explode(',', $company['geocoderAddress']);
            if ($arrAddress[0]) {
                $street = $arrAddress[0];
            }
            if ($arrAddress[1]) {
                $strCity = ltrim($arrAddress[1]);
                $arrCity = explode(' ', $strCity);
                $zip = $arrCity[0];
                $city = $arrCity[1];
            }
            $this->connection->executeUpdate('UPDATE tl_companies SET street=:street, zip=:zip, city=:city WHERE id=:id', array(':street' => $street, ':zip' => $zip, ':city' => $city, ':id' => $company['id']));
        }

        return new MigrationResult(
            true,
            'Migrated companies.'
        );
    }
}
