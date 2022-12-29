<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221221175603 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE sculpture_category (sculpture_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_B5B0375FB2720858 (sculpture_id), INDEX IDX_B5B0375F12469DE2 (category_id), PRIMARY KEY(sculpture_id, category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE sculpture_category ADD CONSTRAINT FK_B5B0375FB2720858 FOREIGN KEY (sculpture_id) REFERENCES sculpture (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sculpture_category ADD CONSTRAINT FK_B5B0375F12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sculpture ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE sculpture ADD CONSTRAINT FK_DF418F57A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_DF418F57A76ED395 ON sculpture (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sculpture_category DROP FOREIGN KEY FK_B5B0375FB2720858');
        $this->addSql('ALTER TABLE sculpture_category DROP FOREIGN KEY FK_B5B0375F12469DE2');
        $this->addSql('DROP TABLE sculpture_category');
        $this->addSql('ALTER TABLE sculpture DROP FOREIGN KEY FK_DF418F57A76ED395');
        $this->addSql('DROP INDEX IDX_DF418F57A76ED395 ON sculpture');
        $this->addSql('ALTER TABLE sculpture DROP user_id');
    }
}
