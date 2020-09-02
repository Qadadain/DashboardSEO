<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200902210622 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE customer (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE domain_name (id INT AUTO_INCREMENT NOT NULL, holder_id INT NOT NULL, name VARCHAR(255) NOT NULL, localisation VARCHAR(255) NOT NULL, expiration_date DATE NOT NULL, INDEX IDX_F3FF5361DEEE62D0 (holder_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sale (id INT AUTO_INCREMENT NOT NULL, domain_name_id INT NOT NULL, customer_id INT NOT NULL, user_id INT DEFAULT NULL, link LONGTEXT NOT NULL, price INT NOT NULL, date DATE DEFAULT NULL, target VARCHAR(255) NOT NULL, sale_number VARCHAR(50) NOT NULL, INDEX IDX_E54BC00593C085CE (domain_name_id), INDEX IDX_E54BC0059395C3F3 (customer_id), INDEX IDX_E54BC005A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, first_name VARCHAR(100) NOT NULL, last_name VARCHAR(100) NOT NULL, pseudo VARCHAR(100) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE domain_name ADD CONSTRAINT FK_F3FF5361DEEE62D0 FOREIGN KEY (holder_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE sale ADD CONSTRAINT FK_E54BC00593C085CE FOREIGN KEY (domain_name_id) REFERENCES domain_name (id)');
        $this->addSql('ALTER TABLE sale ADD CONSTRAINT FK_E54BC0059395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE sale ADD CONSTRAINT FK_E54BC005A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sale DROP FOREIGN KEY FK_E54BC0059395C3F3');
        $this->addSql('ALTER TABLE sale DROP FOREIGN KEY FK_E54BC00593C085CE');
        $this->addSql('ALTER TABLE domain_name DROP FOREIGN KEY FK_F3FF5361DEEE62D0');
        $this->addSql('ALTER TABLE sale DROP FOREIGN KEY FK_E54BC005A76ED395');
        $this->addSql('DROP TABLE customer');
        $this->addSql('DROP TABLE domain_name');
        $this->addSql('DROP TABLE sale');
        $this->addSql('DROP TABLE user');
    }
}
