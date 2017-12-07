-- Project Sasquatch
-- Created by: Donovan Miller
-- Date Created: September 26, 2017
-- Date Edited: October 11, 2017

-- This is the current Sql create table statements
-- All foreign keys are commented out so that this file can 
-- be copied into PHPmyadmin 
-- and the columns that are a Foreign key must be indexed in
-- PHPmyadmin. 

-- -----------------------------------------------------
-- Table Exercise
-- -----------------------------------------------------
CREATE TABLE Exercise (
  exrcise_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  exrcise_name VARCHAR(30) NOT NULL,
  exrcise_type ENUM('WARMUP', 'PUSH', 'PULL', 'LEGS', 'CORE') NOT NULL,
  exrcise_lvl ENUM('EASY', 'INTERMEDIATE', 'HARD') NOT NULL,
  PRIMARY KEY (exrcise_id));


-- -----------------------------------------------------
-- Table Set_Group
-- -----------------------------------------------------
CREATE TABLE Set_Group (
  set_group_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  num_of_sets INT UNSIGNED,
  exercise_id INT UNSIGNED NOT NULL,
  PRIMARY KEY (set_group_id),
  --FOREIGN KEY (exrcise_id) REFERENCES Exercise (exrcise_id)
  );


-- -----------------------------------------------------
-- Table The_Set
-- -----------------------------------------------------
CREATE TABLE The_Set (
  set_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  reps_fin INT UNSIGNED,
  weight_used INT UNSIGNED,
  perceived_exert INT UNSIGNED,
  PRIMARY KEY (set_id),
  --FOREIGN KEY (set_group_id) REFERENCES Set_Group (set_group_id)
  );



-- -----------------------------------------------------
-- Table User
-- -----------------------------------------------------
CREATE TABLE User (
  username VARCHAR(8) NOT NULL,
  password VARCHAR(45) NOT NULL,
  type ENUM('STANDARD', 'ADMIN') NOT NULL,
  class ENUM('PE 157', 'PE 158', 'NONE') NOT NULL,
  team ENUM('FOOTBALL', 'SOFTBALL', 'BASKETBALL', 'CROSS COUNTRY', 'TRACK AND FIELD', 'SOCCER', 'ROWING', 'VOLLEYBALL', 'NONE') NOT NULL,
  f_name VARCHAR(30) NOT NULL,
  l_name VARCHAR(45) NOT NULL,
  PRIMARY KEY (username)
  );


-- -----------------------------------------------------
-- Table Workout
-- -----------------------------------------------------
CREATE TABLE Workout (
  workout_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  workout_name VARCHAR(45) NOT NULL,
  assigned_bool BOOLEAN NOT NULL,
  username VARCHAR(8) NOT NULL,
  PRIMARY KEY (workout_id),
  --FOREIGN KEY (username) REFERENCES User (username)
    );


-- -----------------------------------------------------
-- Table Completed_Workout
-- -----------------------------------------------------
CREATE TABLE Completed_Workout (
  workout_id INT UNSIGNED NOT NULL,
  username VARCHAR(8) NOT NULL,
  date DATE NOT NULL,
  PRIMARY KEY (workout_id),
  --FOREIGN KEY (workout_id) REFERENCES Workout (workout_id),
  --FOREIGN KEY (username) REFERENCES Users (username)
    );


-- -----------------------------------------------------
-- Table Set_Group_In_Workout
-- -----------------------------------------------------
CREATE TABLE Set_Group_In_Workout (
  set_group_id INT UNSIGNED NOT NULL,
  workout_id INT UNSIGNED NOT NULL,
  PRIMARY KEY (set_group_id, workout_id),
  --FOREIGN KEY (set_group_id) REFERENCES Set_Group (set_group_id),
  --FOREIGN KEY (workout_id) REFERENCES Workout (workout_id)
  );

