CREATE DATABASE testdb2;

CREATE TABLE Categories
(
    id        INTEGER PRIMARY KEY,
    name      TEXT NOT NULL,
    alias     TEXT,
    parent_id INTEGER
);
