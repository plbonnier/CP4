<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240201154848 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE adopt (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, orangoutan_id INT NOT NULL, money DOUBLE PRECISION NOT NULL, date DATE NOT NULL, INDEX IDX_EDE8897AA76ED395 (user_id), INDEX IDX_EDE8897A49730777 (orangoutan_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_orang_outan (user_id INT NOT NULL, orang_outan_id INT NOT NULL, INDEX IDX_C2BC602A76ED395 (user_id), INDEX IDX_C2BC6023F5C4783 (orang_outan_id), PRIMARY KEY(user_id, orang_outan_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE adopt ADD CONSTRAINT FK_EDE8897AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE adopt ADD CONSTRAINT FK_EDE8897A49730777 FOREIGN KEY (orangoutan_id) REFERENCES orang_outan (id)');
        $this->addSql('ALTER TABLE user_orang_outan ADD CONSTRAINT FK_C2BC602A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_orang_outan ADD CONSTRAINT FK_C2BC6023F5C4783 FOREIGN KEY (orang_outan_id) REFERENCES orang_outan (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adopt DROP FOREIGN KEY FK_EDE8897AA76ED395');
        $this->addSql('ALTER TABLE adopt DROP FOREIGN KEY FK_EDE8897A49730777');
        $this->addSql('ALTER TABLE user_orang_outan DROP FOREIGN KEY FK_C2BC602A76ED395');
        $this->addSql('ALTER TABLE user_orang_outan DROP FOREIGN KEY FK_C2BC6023F5C4783');
        $this->addSql('DROP TABLE adopt');
        $this->addSql('DROP TABLE user_orang_outan');
    }
}
