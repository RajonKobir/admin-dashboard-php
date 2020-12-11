CREATE TABLE IF NOT EXISTS "admin" (
	"id"	INTEGER,
	"userid"	varchar(20) DEFAULT NULL,
	"password"	varchar(20) DEFAULT NULL,
	"join_pass"	varchar(20) DEFAULT NULL,
	PRIMARY KEY("id" AUTOINCREMENT)
);
CREATE TABLE IF NOT EXISTS "tree" (
	"id"	INTEGER,
	"userid"	varchar(50) DEFAULT NULL,
	"user_name"	varchar(50) DEFAULT NULL,
	"under_userid"	varchar(50) DEFAULT NULL,
	"side"	varchar(50) DEFAULT NULL,
	"left"	varchar(50) DEFAULT NULL,
	"right"	varchar(50) DEFAULT NULL,
	"leftcount"	int(11) DEFAULT 0,
	"rightcount"	int(11) DEFAULT 0,
	"temp_leftcount"	int(11) DEFAULT 0,
	"temp_rightcount"	int(11) DEFAULT 0,
	"stage"	int(11) DEFAULT 0,
	"level"	int(11) DEFAULT 0,
	"l1"	date DEFAULT NULL,
	"l2"	date DEFAULT NULL,
	"l3"	date DEFAULT NULL,
	"l4"	date DEFAULT NULL,
	"l1_half"	date DEFAULT NULL,
	"l2_half"	date DEFAULT NULL,
	"l3_half"	date DEFAULT NULL,
	"l4_half"	date DEFAULT NULL,
	PRIMARY KEY("id" AUTOINCREMENT)
);
CREATE TABLE IF NOT EXISTS "user" (
	"id"	INTEGER,
	"user_id"	varchar(11) DEFAULT NULL,
	"joining_date"	date DEFAULT '2020-01-01',
	"user_name"	varchar(20) DEFAULT NULL,
	"email"	varchar(20) DEFAULT NULL,
	"mobile"	varchar(20) DEFAULT NULL,
	"under_userid"	varchar(20) DEFAULT NULL,
	"side"	 DEFAULT NULL CHECK("side" IN ('left', 'right')),
	"user_batch"	varchar(11) DEFAULT NULL,
	"father_name"	varchar(20) DEFAULT NULL,
	"mother_name"	varchar(20) DEFAULT NULL,
	"village_name"	varchar(30) DEFAULT NULL,
	"post_number"	varchar(20) DEFAULT NULL,
	"upazilla_name"	varchar(20) DEFAULT NULL,
	"zilla_name"	varchar(20) DEFAULT NULL,
	"nominee_name"	varchar(20) DEFAULT NULL,
	"nominee_mobile"	varchar(20) DEFAULT NULL,
	"nominee_relation"	varchar(20) DEFAULT NULL,
	"nominee_address"	varchar(255) DEFAULT NULL,
	PRIMARY KEY("id" AUTOINCREMENT)
);
INSERT INTO "admin" VALUES (1,'','01726468340','01726468340');
