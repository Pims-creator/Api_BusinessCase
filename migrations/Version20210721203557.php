<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210721203557 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adresse ADD garage_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE adresse ADD CONSTRAINT FK_C35F0816C4FFF555 FOREIGN KEY (garage_id) REFERENCES garage (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C35F0816C4FFF555 ON adresse (garage_id)');
        $this->addSql('ALTER TABLE annonce ADD modele_id INT NOT NULL, ADD carburant_id INT NOT NULL, ADD categorie_id INT NOT NULL');
        $this->addSql('ALTER TABLE annonce ADD CONSTRAINT FK_F65593E5AC14B70A FOREIGN KEY (modele_id) REFERENCES modele (id)');
        $this->addSql('ALTER TABLE annonce ADD CONSTRAINT FK_F65593E532DAAD24 FOREIGN KEY (carburant_id) REFERENCES carburant (id)');
        $this->addSql('ALTER TABLE annonce ADD CONSTRAINT FK_F65593E5BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('CREATE INDEX IDX_F65593E5AC14B70A ON annonce (modele_id)');
        $this->addSql('CREATE INDEX IDX_F65593E532DAAD24 ON annonce (carburant_id)');
        $this->addSql('CREATE INDEX IDX_F65593E5BCF5E72D ON annonce (categorie_id)');
        $this->addSql('ALTER TABLE garage ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE garage ADD CONSTRAINT FK_9F26610BA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_9F26610BA76ED395 ON garage (user_id)');
        $this->addSql('ALTER TABLE modele ADD marque_id INT NOT NULL');
        $this->addSql('ALTER TABLE modele ADD CONSTRAINT FK_100285584827B9B2 FOREIGN KEY (marque_id) REFERENCES marque (id)');
        $this->addSql('CREATE INDEX IDX_100285584827B9B2 ON modele (marque_id)');
        $this->addSql('ALTER TABLE photo ADD annonce_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE photo ADD CONSTRAINT FK_14B784188805AB2F FOREIGN KEY (annonce_id) REFERENCES annonce (id)');
        $this->addSql('CREATE INDEX IDX_14B784188805AB2F ON photo (annonce_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adresse DROP FOREIGN KEY FK_C35F0816C4FFF555');
        $this->addSql('DROP INDEX UNIQ_C35F0816C4FFF555 ON adresse');
        $this->addSql('ALTER TABLE adresse DROP garage_id');
        $this->addSql('ALTER TABLE annonce DROP FOREIGN KEY FK_F65593E5AC14B70A');
        $this->addSql('ALTER TABLE annonce DROP FOREIGN KEY FK_F65593E532DAAD24');
        $this->addSql('ALTER TABLE annonce DROP FOREIGN KEY FK_F65593E5BCF5E72D');
        $this->addSql('DROP INDEX IDX_F65593E5AC14B70A ON annonce');
        $this->addSql('DROP INDEX IDX_F65593E532DAAD24 ON annonce');
        $this->addSql('DROP INDEX IDX_F65593E5BCF5E72D ON annonce');
        $this->addSql('ALTER TABLE annonce DROP modele_id, DROP carburant_id, DROP categorie_id');
        $this->addSql('ALTER TABLE garage DROP FOREIGN KEY FK_9F26610BA76ED395');
        $this->addSql('DROP INDEX IDX_9F26610BA76ED395 ON garage');
        $this->addSql('ALTER TABLE garage DROP user_id');
        $this->addSql('ALTER TABLE modele DROP FOREIGN KEY FK_100285584827B9B2');
        $this->addSql('DROP INDEX IDX_100285584827B9B2 ON modele');
        $this->addSql('ALTER TABLE modele DROP marque_id');
        $this->addSql('ALTER TABLE photo DROP FOREIGN KEY FK_14B784188805AB2F');
        $this->addSql('DROP INDEX IDX_14B784188805AB2F ON photo');
        $this->addSql('ALTER TABLE photo DROP annonce_id');
    }
}
