<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230327145800 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C4C9838EE');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C9D86650F');
        $this->addSql('DROP INDEX IDX_9474526C4C9838EE ON comment');
        $this->addSql('DROP INDEX IDX_9474526C9D86650F ON comment');
        $this->addSql('ALTER TABLE comment ADD shoes_id INT DEFAULT NULL, ADD user_id INT DEFAULT NULL, DROP shoes_id_id, DROP user_id_id');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CB75E1D7A FOREIGN KEY (shoes_id) REFERENCES shoes (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_9474526CB75E1D7A ON comment (shoes_id)');
        $this->addSql('CREATE INDEX IDX_9474526CA76ED395 ON comment (user_id)');
        $this->addSql('ALTER TABLE `like` DROP FOREIGN KEY FK_AC6340B34C9838EE');
        $this->addSql('ALTER TABLE `like` DROP FOREIGN KEY FK_AC6340B39D86650F');
        $this->addSql('DROP INDEX IDX_AC6340B34C9838EE ON `like`');
        $this->addSql('DROP INDEX IDX_AC6340B39D86650F ON `like`');
        $this->addSql('ALTER TABLE `like` ADD shoes_id INT DEFAULT NULL, ADD user_id INT DEFAULT NULL, DROP shoes_id_id, DROP user_id_id');
        $this->addSql('ALTER TABLE `like` ADD CONSTRAINT FK_AC6340B3B75E1D7A FOREIGN KEY (shoes_id) REFERENCES shoes (id)');
        $this->addSql('ALTER TABLE `like` ADD CONSTRAINT FK_AC6340B3A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_AC6340B3B75E1D7A ON `like` (shoes_id)');
        $this->addSql('CREATE INDEX IDX_AC6340B3A76ED395 ON `like` (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CB75E1D7A');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CA76ED395');
        $this->addSql('DROP INDEX IDX_9474526CB75E1D7A ON comment');
        $this->addSql('DROP INDEX IDX_9474526CA76ED395 ON comment');
        $this->addSql('ALTER TABLE comment ADD shoes_id_id INT DEFAULT NULL, ADD user_id_id INT DEFAULT NULL, DROP shoes_id, DROP user_id');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C4C9838EE FOREIGN KEY (shoes_id_id) REFERENCES shoes (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C9D86650F FOREIGN KEY (user_id_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_9474526C4C9838EE ON comment (shoes_id_id)');
        $this->addSql('CREATE INDEX IDX_9474526C9D86650F ON comment (user_id_id)');
        $this->addSql('ALTER TABLE `like` DROP FOREIGN KEY FK_AC6340B3B75E1D7A');
        $this->addSql('ALTER TABLE `like` DROP FOREIGN KEY FK_AC6340B3A76ED395');
        $this->addSql('DROP INDEX IDX_AC6340B3B75E1D7A ON `like`');
        $this->addSql('DROP INDEX IDX_AC6340B3A76ED395 ON `like`');
        $this->addSql('ALTER TABLE `like` ADD shoes_id_id INT DEFAULT NULL, ADD user_id_id INT DEFAULT NULL, DROP shoes_id, DROP user_id');
        $this->addSql('ALTER TABLE `like` ADD CONSTRAINT FK_AC6340B34C9838EE FOREIGN KEY (shoes_id_id) REFERENCES shoes (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE `like` ADD CONSTRAINT FK_AC6340B39D86650F FOREIGN KEY (user_id_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_AC6340B34C9838EE ON `like` (shoes_id_id)');
        $this->addSql('CREATE INDEX IDX_AC6340B39D86650F ON `like` (user_id_id)');
    }
}
