CREATE OR REPLACE TABLE `songs` (
	`id` INTEGER NOT NULL AUTO_INCREMENT UNIQUE,
	`name` TEXT,
	`album` INTEGER,
	PRIMARY KEY(`id`)
);

CREATE OR REPLACE TABLE `album` (
	`id` INTEGER NOT NULL AUTO_INCREMENT UNIQUE,
	`name` TEXT,
	`portada` TEXT,
	PRIMARY KEY(`id`)
);

INSERT INTO `album` (name, portada) VALUES
('Save Rock and Roll', 'https://link-a-portada.com/american-beauty'),  -- Fall Out Boy
('Meteora', 'https://link-a-portada.com/meteora'),  -- Linkin Park
('Master of Puppets', 'https://link-a-portada.com/master-of-puppets'),  -- Metallica
('Hybrid Theory', 'https://link-a-portada.com/hybrid-theory'),  -- Linkin Park
('Death Magnetic', 'https://link-a-portada.com/death-magnetic');  -- Metallica


INSERT INTO `songs` (name, album) VALUES
('Phoenix', 1),  -- Fall Out Boy
('Centuries', 1),  -- Fall Out Boy
('Until I Break', 1),  -- Fall Out Boy
('Somewhere I Belong', 2),  -- Linkin Park
('Faint', 2),  -- Linkin Park
('Breaking the Habit', 2),  -- Linkin Park
('Enter Sandman', 3),  -- Metallica
('Master of Puppets', 3),  -- Metallica
('The Thing That Should Not Be', 3),  -- Metallica
('Papercut', 4),  -- Linkin Park
('One Step Closer', 4),  -- Linkin Park
('Crawling', 4),  -- Linkin Park
('That Was Just Your Life', 5),  -- Metallica
('The End of the Line', 5),  -- Metallica
('Broken, Beat & Scarred', 5);  -- Metallica


ALTER TABLE `album`
ADD FOREIGN KEY(`id`) REFERENCES `songs`(`id`)
ON UPDATE NO ACTION ON DELETE NO ACTION;