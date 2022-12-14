<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221206161138 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE peinture_category (peinture_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_4E86B85C2E869AB (peinture_id), INDEX IDX_4E86B8512469DE2 (category_id), PRIMARY KEY(peinture_id, category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE peinture_category ADD CONSTRAINT FK_4E86B85C2E869AB FOREIGN KEY (peinture_id) REFERENCES peinture (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE peinture_category ADD CONSTRAINT FK_4E86B8512469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE peinture ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE peinture ADD CONSTRAINT FK_8FB3A9D6A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_8FB3A9D6A76ED395 ON peinture (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE peinture_category DROP FOREIGN KEY FK_4E86B85C2E869AB');
        $this->addSql('ALTER TABLE peinture_category DROP FOREIGN KEY FK_4E86B8512469DE2');
        $this->addSql('DROP TABLE peinture_category');
        $this->addSql('ALTER TABLE peinture DROP FOREIGN KEY FK_8FB3A9D6A76ED395');
        $this->addSql('DROP INDEX IDX_8FB3A9D6A76ED395 ON peinture');
        $this->addSql('ALTER TABLE peinture DROP user_id');
    }
}
