<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200827141326 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE customer (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE domain_name (id INT AUTO_INCREMENT NOT NULL, holder_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_F3FF5361DEEE62D0 (holder_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sale (id INT AUTO_INCREMENT NOT NULL, domaine_name_id INT NOT NULL, customer_id INT NOT NULL, link LONGTEXT NOT NULL, price INT NOT NULL, date DATE DEFAULT NULL, INDEX IDX_E54BC005ADCE78A8 (domaine_name_id), INDEX IDX_E54BC0059395C3F3 (customer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, first_name VARCHAR(100) NOT NULL, last_name VARCHAR(100) NOT NULL, pseudo VARCHAR(100) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE domain_name ADD CONSTRAINT FK_F3FF5361DEEE62D0 FOREIGN KEY (holder_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE sale ADD CONSTRAINT FK_E54BC005ADCE78A8 FOREIGN KEY (domaine_name_id) REFERENCES domain_name (id)');
        $this->addSql('ALTER TABLE sale ADD CONSTRAINT FK_E54BC0059395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sale DROP FOREIGN KEY FK_E54BC0059395C3F3');
        $this->addSql('ALTER TABLE sale DROP FOREIGN KEY FK_E54BC005ADCE78A8');
        $this->addSql('ALTER TABLE domain_name DROP FOREIGN KEY FK_F3FF5361DEEE62D0');
        $this->addSql('DROP TABLE customer');
        $this->addSql('DROP TABLE domain_name');
        $this->addSql('DROP TABLE sale');
        $this->addSql('DROP TABLE user');
    }
}
