<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201215161515 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Pirkejai ADD adresas VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE Uzsakymai DROP FOREIGN KEY Uzsakymai_ibfk_1');
        $this->addSql('ALTER TABLE Uzsakymai DROP FOREIGN KEY Uzsakymai_ibfk_2');
        $this->addSql('ALTER TABLE Uzsakymai ADD CONSTRAINT FK_D26F9A5938F11F6 FOREIGN KEY (fk_Filmasid) REFERENCES Filmai (id)');
        $this->addSql('ALTER TABLE Uzsakymai ADD CONSTRAINT FK_D26F9A59D825F65 FOREIGN KEY (fk_Pirkejasid) REFERENCES Pirkejai (id)');
        $this->addSql('ALTER TABLE Uzsakymai RENAME INDEX uzsakymai_ibfk_1 TO fk_Filmasid');
        $this->addSql('ALTER TABLE Uzsakymai RENAME INDEX uzsakymai_ibfk_2 TO fk_Pirkejasid');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Pirkejai DROP adresas');
        $this->addSql('ALTER TABLE Uzsakymai DROP FOREIGN KEY FK_D26F9A5938F11F6');
        $this->addSql('ALTER TABLE Uzsakymai DROP FOREIGN KEY FK_D26F9A59D825F65');
        $this->addSql('ALTER TABLE Uzsakymai ADD CONSTRAINT Uzsakymai_ibfk_1 FOREIGN KEY (fk_Filmasid) REFERENCES Filmai (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE Uzsakymai ADD CONSTRAINT Uzsakymai_ibfk_2 FOREIGN KEY (fk_Pirkejasid) REFERENCES Pirkejai (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE Uzsakymai RENAME INDEX fk_filmasid TO Uzsakymai_ibfk_1');
        $this->addSql('ALTER TABLE Uzsakymai RENAME INDEX fk_pirkejasid TO Uzsakymai_ibfk_2');
    }
}
