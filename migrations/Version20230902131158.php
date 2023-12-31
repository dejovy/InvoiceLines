<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230902131158 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE invoice_line DROP INDEX UNIQ_D3D1D6932989F1FD, ADD INDEX IDX_D3D1D6932989F1FD (invoice_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE invoice_line DROP INDEX IDX_D3D1D6932989F1FD, ADD UNIQUE INDEX UNIQ_D3D1D6932989F1FD (invoice_id)');
    }
}
