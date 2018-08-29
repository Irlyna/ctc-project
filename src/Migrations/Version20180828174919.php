<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180828174919 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE Ingredient (id BIGINT AUTO_INCREMENT NOT NULL, name VARCHAR(40) NOT NULL, UNIQUE INDEX UNIQ_24F27BA05E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ingredients_categories (ingredient_id BIGINT NOT NULL, ingredient_category_id BIGINT NOT NULL, INDEX IDX_FCF0EEF0933FE08C (ingredient_id), INDEX IDX_FCF0EEF0AA35537B (ingredient_category_id), PRIMARY KEY(ingredient_id, ingredient_category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Ingredient_Category (id BIGINT AUTO_INCREMENT NOT NULL, name VARCHAR(40) NOT NULL, UNIQUE INDEX UNIQ_ABB85D0D5E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Recipe (id BIGINT AUTO_INCREMENT NOT NULL, user_id BIGINT DEFAULT NULL, name VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, date DATETIME NOT NULL, INDEX IDX_DD24B401A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recipes_ingredients (recipe_id BIGINT NOT NULL, ingredient_id BIGINT NOT NULL, INDEX IDX_761206B059D8A214 (recipe_id), INDEX IDX_761206B0933FE08C (ingredient_id), PRIMARY KEY(recipe_id, ingredient_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recipes_categories (recipe_id BIGINT NOT NULL, recipe_category_id BIGINT NOT NULL, INDEX IDX_90716E0D59D8A214 (recipe_id), INDEX IDX_90716E0DC6B4D386 (recipe_category_id), PRIMARY KEY(recipe_id, recipe_category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Recipe_Category (id BIGINT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, UNIQUE INDEX UNIQ_16FE0975E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id BIGINT AUTO_INCREMENT NOT NULL, username VARCHAR(40) NOT NULL, name VARCHAR(40) NOT NULL, firstname VARCHAR(40) NOT NULL, email VARCHAR(40) NOT NULL, password VARCHAR(255) NOT NULL, roles JSON NOT NULL, UNIQUE INDEX UNIQ_1483A5E9F85E0677 (username), UNIQUE INDEX UNIQ_1483A5E9E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ingredients_categories ADD CONSTRAINT FK_FCF0EEF0933FE08C FOREIGN KEY (ingredient_id) REFERENCES Ingredient (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ingredients_categories ADD CONSTRAINT FK_FCF0EEF0AA35537B FOREIGN KEY (ingredient_category_id) REFERENCES Ingredient_Category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE Recipe ADD CONSTRAINT FK_DD24B401A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE recipes_ingredients ADD CONSTRAINT FK_761206B059D8A214 FOREIGN KEY (recipe_id) REFERENCES Recipe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recipes_ingredients ADD CONSTRAINT FK_761206B0933FE08C FOREIGN KEY (ingredient_id) REFERENCES Ingredient (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recipes_categories ADD CONSTRAINT FK_90716E0D59D8A214 FOREIGN KEY (recipe_id) REFERENCES Recipe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recipes_categories ADD CONSTRAINT FK_90716E0DC6B4D386 FOREIGN KEY (recipe_category_id) REFERENCES Recipe_Category (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ingredients_categories DROP FOREIGN KEY FK_FCF0EEF0933FE08C');
        $this->addSql('ALTER TABLE recipes_ingredients DROP FOREIGN KEY FK_761206B0933FE08C');
        $this->addSql('ALTER TABLE ingredients_categories DROP FOREIGN KEY FK_FCF0EEF0AA35537B');
        $this->addSql('ALTER TABLE recipes_ingredients DROP FOREIGN KEY FK_761206B059D8A214');
        $this->addSql('ALTER TABLE recipes_categories DROP FOREIGN KEY FK_90716E0D59D8A214');
        $this->addSql('ALTER TABLE recipes_categories DROP FOREIGN KEY FK_90716E0DC6B4D386');
        $this->addSql('ALTER TABLE Recipe DROP FOREIGN KEY FK_DD24B401A76ED395');
        $this->addSql('DROP TABLE Ingredient');
        $this->addSql('DROP TABLE ingredients_categories');
        $this->addSql('DROP TABLE Ingredient_Category');
        $this->addSql('DROP TABLE Recipe');
        $this->addSql('DROP TABLE recipes_ingredients');
        $this->addSql('DROP TABLE recipes_categories');
        $this->addSql('DROP TABLE Recipe_Category');
        $this->addSql('DROP TABLE users');
    }
}
