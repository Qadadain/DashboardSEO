<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200828172406 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sale DROP FOREIGN KEY FK_E54BC005ADCE78A8');
        $this->addSql('DROP INDEX IDX_E54BC005ADCE78A8 ON sale');
        $this->addSql('ALTER TABLE sale ADD user_id INT DEFAULT NULL, CHANGE domaine_name_id domain_name_id INT NOT NULL');
        $this->addSql('ALTER TABLE sale ADD CONSTRAINT FK_E54BC00593C085CE FOREIGN KEY (domain_name_id) REFERENCES domain_name (id)');
        $this->addSql('ALTER TABLE sale ADD CONSTRAINT FK_E54BC005A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_E54BC00593C085CE ON sale (domain_name_id)');
        $this->addSql('CREATE INDEX IDX_E54BC005A76ED395 ON sale (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sale DROP FOREIGN KEY FK_E54BC00593C085CE');
        $this->addSql('ALTER TABLE sale DROP FOREIGN KEY FK_E54BC005A76ED395');
        $this->addSql('DROP INDEX IDX_E54BC00593C085CE ON sale');
        $this->addSql('DROP INDEX IDX_E54BC005A76ED395 ON sale');
        $this->addSql('ALTER TABLE sale DROP user_id, CHANGE domain_name_id domaine_name_id INT NOT NULL');
        $this->addSql('ALTER TABLE sale ADD CONSTRAINT FK_E54BC005ADCE78A8 FOREIGN KEY (domaine_name_id) REFERENCES domain_name (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_E54BC005ADCE78A8 ON sale (domaine_name_id)');
    }
}
