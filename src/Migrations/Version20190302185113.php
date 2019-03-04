<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190302185113 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE pessoas');
        $this->addSql('ALTER TABLE empresas MODIFY nuSeqEmpresa INT NOT NULL');
        $this->addSql('ALTER TABLE empresas DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE empresas ADD co_cnpj TINYTEXT NOT NULL, ADD razao_social TINYTEXT NOT NULL, DROP coCnpj, DROP razaoSocial, CHANGE nuseqempresa nu_seq_empresa INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE empresas ADD PRIMARY KEY (nu_seq_empresa)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE pessoas (nuSeqPessoa INT AUTO_INCREMENT NOT NULL, nuSeqEmpresa SMALLINT DEFAULT NULL, coCpfCnpj VARCHAR(255) DEFAULT NULL COLLATE latin1_swedish_ci, dsNome VARCHAR(255) DEFAULT NULL COLLATE latin1_swedish_ci, PRIMARY KEY(nuSeqPessoa)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE empresas MODIFY nu_seq_empresa INT NOT NULL');
        $this->addSql('ALTER TABLE empresas DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE empresas ADD coCnpj VARCHAR(255) DEFAULT NULL COLLATE latin1_swedish_ci, ADD razaoSocial VARCHAR(255) DEFAULT NULL COLLATE latin1_swedish_ci, DROP co_cnpj, DROP razao_social, CHANGE nu_seq_empresa nuSeqEmpresa INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE empresas ADD PRIMARY KEY (nuSeqEmpresa)');
    }
}
