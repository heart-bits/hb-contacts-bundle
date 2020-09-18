<?php

namespace Heartbits\ContaoContacts\Migration;

use Contao\CoreBundle\Migration\AbstractMigration;
use Contao\CoreBundle\Migration\MigrationResult;
use Doctrine\DBAL\Connection;

class ContactMigration extends AbstractMigration
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
        if (!$schemaManager->tablesExist(['tl_contacts'])) {
            return false;
        }

        $columns = $schemaManager->listTableColumns('tl_contacts');

        return
            isset($columns['geocoderAddress']) &&
            isset($columns['geocoderCountry']) &&
            isset($columns['company']) &&
            !isset($columns['pid']) &&
            !isset($columns['street']) &&
            !isset($columns['zip']) &&
            !isset($columns['city']) &&
            !isset($columns['country']);
    }

    public function run(): MigrationResult
    {
        $this->connection->query('ALTER TABLE tl_contacts ADD street varchar(255) NOT NULL default ""');
        $this->connection->query('ALTER TABLE tl_contacts ADD zip CHAR(5) NOT NULL default ""');
        $this->connection->query('ALTER TABLE tl_contacts ADD city varchar(255) NOT NULL default ""');
        $this->connection->query('ALTER TABLE tl_contacts ADD country varchar(2) NOT NULL default "de"');
        $this->connection->query('ALTER TABLE tl_contacts ADD pid int(10) unsigned NOT NULL default "0"');

        // Set old company as new pid
        $this->connection->executeUpdate('UPDATE tl_contacts SET pid = company');
        $this->connection->executeUpdate('UPDATE tl_contacts SET country = geocoderCountry');

        // Get all contacts and split the addresses into the corresponding fields
        $contacts = $this->connection->fetchAll('SELECT id,geocoderAddress FROM tl_contacts');
        foreach ($contacts as $contact) {
            $street = '';
            $zip = '';
            $city = '';
            $arrAddress = explode(',', $contact['geocoderAddress']);
            if ($arrAddress[0]) {
                $street = $arrAddress[0];
            }
            if ($arrAddress[1]) {
                $strCity = ltrim($arrAddress[1]);
                $arrCity = explode(' ', $strCity);
                $zip = $arrCity[0];
                $city = $arrCity[1];
            }
            $this->connection->executeUpdate('UPDATE tl_contacts SET street=:street, zip=:zip, city=:city WHERE id=:id', array(':street' => $street, ':zip' => $zip, ':city' => $city, ':id' => $contact['id']));
        }

        return new MigrationResult(
            true,
            'Migrated contacts.'
        );
    }
}
