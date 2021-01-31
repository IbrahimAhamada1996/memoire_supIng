<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210125134102 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE transfert ADD CONSTRAINT FK_1E4EACBB357C0A59 FOREIGN KEY (tarif_id) REFERENCES tarif (id)');
        $this->addSql('CREATE INDEX IDX_1E4EACBB357C0A59 ON transfert (tarif_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE transfert DROP FOREIGN KEY FK_1E4EACBB357C0A59');
        $this->addSql('DROP INDEX IDX_1E4EACBB357C0A59 ON transfert');
    }
}
