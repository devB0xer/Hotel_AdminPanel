<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240814095406 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE Booking (id INT AUTO_INCREMENT NOT NULL, guest_id INT NOT NULL, room_id INT NOT NULL, check_in_date DATETIME NOT NULL, check_out_date DATETIME NOT NULL, is_checked_out TINYINT(1) NOT NULL, INDEX IDX_2FB1D4429A4AA658 (guest_id), INDEX IDX_2FB1D44254177093 (room_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Employee (id INT AUTO_INCREMENT NOT NULL, position_id INT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, phone VARCHAR(20) NOT NULL, email VARCHAR(255) NOT NULL, INDEX IDX_A4E917F7DD842E46 (position_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Guest (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, date_of_birth DATE NOT NULL, email VARCHAR(255) DEFAULT NULL, phone VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Passport (id INT AUTO_INCREMENT NOT NULL, guest_id INT NOT NULL, type VARCHAR(50) NOT NULL, number VARCHAR(20) NOT NULL, issue_date DATE NOT NULL, issuing_country VARCHAR(50) NOT NULL, INDEX IDX_4CD40C5E9A4AA658 (guest_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Position (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Room (id INT AUTO_INCREMENT NOT NULL, room_number VARCHAR(10) NOT NULL, room_type VARCHAR(50) DEFAULT NULL, is_active TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE RoomPrices (id INT AUTO_INCREMENT NOT NULL, room_id INT NOT NULL, price NUMERIC(10, 2) NOT NULL, start_date DATE NOT NULL, end_date DATE NOT NULL, is_default TINYINT(1) NOT NULL, INDEX IDX_6CBE268854177093 (room_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE RoomService (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE RoomServiceOrder (id INT AUTO_INCREMENT NOT NULL, booking_id INT NOT NULL, room_service_id INT NOT NULL, employee_id INT NOT NULL, request_date DATETIME NOT NULL, completion_date DATETIME DEFAULT NULL, status VARCHAR(255) NOT NULL, INDEX IDX_E208C42F3301C60 (booking_id), INDEX IDX_E208C42FD9AED9FA (room_service_id), INDEX IDX_E208C42F8C03F15C (employee_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Service (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, decription LONGTEXT NOT NULL, is_active TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ServiceOrder (id INT AUTO_INCREMENT NOT NULL, booking_id INT NOT NULL, service_id INT NOT NULL, quantity INT NOT NULL, INDEX IDX_BFBFA3933301C60 (booking_id), INDEX IDX_BFBFA393ED5CA9E6 (service_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ServicePrice (id INT AUTO_INCREMENT NOT NULL, service_id INT NOT NULL, price NUMERIC(10, 2) NOT NULL, start_date DATE NOT NULL, end_date DATE NOT NULL, is_default TINYINT(1) NOT NULL, INDEX IDX_805E12D2ED5CA9E6 (service_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE User (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE Booking ADD CONSTRAINT FK_2FB1D4429A4AA658 FOREIGN KEY (guest_id) REFERENCES Guest (id)');
        $this->addSql('ALTER TABLE Booking ADD CONSTRAINT FK_2FB1D44254177093 FOREIGN KEY (room_id) REFERENCES Room (id)');
        $this->addSql('ALTER TABLE Employee ADD CONSTRAINT FK_A4E917F7DD842E46 FOREIGN KEY (position_id) REFERENCES Position (id)');
        $this->addSql('ALTER TABLE Passport ADD CONSTRAINT FK_4CD40C5E9A4AA658 FOREIGN KEY (guest_id) REFERENCES Guest (id)');
        $this->addSql('ALTER TABLE RoomPrices ADD CONSTRAINT FK_6CBE268854177093 FOREIGN KEY (room_id) REFERENCES Room (id)');
        $this->addSql('ALTER TABLE RoomServiceOrder ADD CONSTRAINT FK_E208C42F3301C60 FOREIGN KEY (booking_id) REFERENCES Booking (id)');
        $this->addSql('ALTER TABLE RoomServiceOrder ADD CONSTRAINT FK_E208C42FD9AED9FA FOREIGN KEY (room_service_id) REFERENCES RoomService (id)');
        $this->addSql('ALTER TABLE RoomServiceOrder ADD CONSTRAINT FK_E208C42F8C03F15C FOREIGN KEY (employee_id) REFERENCES Employee (id)');
        $this->addSql('ALTER TABLE ServiceOrder ADD CONSTRAINT FK_BFBFA3933301C60 FOREIGN KEY (booking_id) REFERENCES Booking (id)');
        $this->addSql('ALTER TABLE ServiceOrder ADD CONSTRAINT FK_BFBFA393ED5CA9E6 FOREIGN KEY (service_id) REFERENCES Service (id)');
        $this->addSql('ALTER TABLE ServicePrice ADD CONSTRAINT FK_805E12D2ED5CA9E6 FOREIGN KEY (service_id) REFERENCES Service (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Booking DROP FOREIGN KEY FK_2FB1D4429A4AA658');
        $this->addSql('ALTER TABLE Booking DROP FOREIGN KEY FK_2FB1D44254177093');
        $this->addSql('ALTER TABLE Employee DROP FOREIGN KEY FK_A4E917F7DD842E46');
        $this->addSql('ALTER TABLE Passport DROP FOREIGN KEY FK_4CD40C5E9A4AA658');
        $this->addSql('ALTER TABLE RoomPrices DROP FOREIGN KEY FK_6CBE268854177093');
        $this->addSql('ALTER TABLE RoomServiceOrder DROP FOREIGN KEY FK_E208C42F3301C60');
        $this->addSql('ALTER TABLE RoomServiceOrder DROP FOREIGN KEY FK_E208C42FD9AED9FA');
        $this->addSql('ALTER TABLE RoomServiceOrder DROP FOREIGN KEY FK_E208C42F8C03F15C');
        $this->addSql('ALTER TABLE ServiceOrder DROP FOREIGN KEY FK_BFBFA3933301C60');
        $this->addSql('ALTER TABLE ServiceOrder DROP FOREIGN KEY FK_BFBFA393ED5CA9E6');
        $this->addSql('ALTER TABLE ServicePrice DROP FOREIGN KEY FK_805E12D2ED5CA9E6');
        $this->addSql('DROP TABLE Booking');
        $this->addSql('DROP TABLE Employee');
        $this->addSql('DROP TABLE Guest');
        $this->addSql('DROP TABLE Passport');
        $this->addSql('DROP TABLE Position');
        $this->addSql('DROP TABLE Room');
        $this->addSql('DROP TABLE RoomPrices');
        $this->addSql('DROP TABLE RoomService');
        $this->addSql('DROP TABLE RoomServiceOrder');
        $this->addSql('DROP TABLE Service');
        $this->addSql('DROP TABLE ServiceOrder');
        $this->addSql('DROP TABLE ServicePrice');
        $this->addSql('DROP TABLE User');
    }
}
