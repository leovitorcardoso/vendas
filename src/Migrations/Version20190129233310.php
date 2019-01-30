<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190129233310 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE venda_produto DROP FOREIGN KEY FK_79E405D3CDBF150D');
        $this->addSql('ALTER TABLE venda_produto DROP FOREIGN KEY FK_79E405D3E3A18626');
        $this->addSql('DROP INDEX IDX_79E405D3CDBF150D ON venda_produto');
        $this->addSql('DROP INDEX IDX_79E405D3E3A18626 ON venda_produto');
        $this->addSql('ALTER TABLE venda_produto ADD venda_id INT NOT NULL, ADD produto_id INT NOT NULL, DROP venda_id_id, DROP produto_id_id');
        $this->addSql('ALTER TABLE venda_produto ADD CONSTRAINT FK_79E405D3924517DF FOREIGN KEY (venda_id) REFERENCES venda (id)');
        $this->addSql('ALTER TABLE venda_produto ADD CONSTRAINT FK_79E405D3105CFD56 FOREIGN KEY (produto_id) REFERENCES produto (id)');
        $this->addSql('CREATE INDEX IDX_79E405D3924517DF ON venda_produto (venda_id)');
        $this->addSql('CREATE INDEX IDX_79E405D3105CFD56 ON venda_produto (produto_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE venda_produto DROP FOREIGN KEY FK_79E405D3924517DF');
        $this->addSql('ALTER TABLE venda_produto DROP FOREIGN KEY FK_79E405D3105CFD56');
        $this->addSql('DROP INDEX IDX_79E405D3924517DF ON venda_produto');
        $this->addSql('DROP INDEX IDX_79E405D3105CFD56 ON venda_produto');
        $this->addSql('ALTER TABLE venda_produto ADD venda_id_id INT NOT NULL, ADD produto_id_id INT NOT NULL, DROP venda_id, DROP produto_id');
        $this->addSql('ALTER TABLE venda_produto ADD CONSTRAINT FK_79E405D3CDBF150D FOREIGN KEY (produto_id_id) REFERENCES produto (id)');
        $this->addSql('ALTER TABLE venda_produto ADD CONSTRAINT FK_79E405D3E3A18626 FOREIGN KEY (venda_id_id) REFERENCES venda (id)');
        $this->addSql('CREATE INDEX IDX_79E405D3CDBF150D ON venda_produto (produto_id_id)');
        $this->addSql('CREATE INDEX IDX_79E405D3E3A18626 ON venda_produto (venda_id_id)');
    }
}
