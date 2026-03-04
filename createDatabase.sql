CREATE TABLE public.authors
(
    id SERIAL PRIMARY KEY,
    author VARCHAR(50) NOT NULL
);

CREATE TABLE public.categories
(
    id SERIAL PRIMARY KEY,
    category VARCHAR(20) NOT NULL
);

CREATE TABLE public.quotes
(
    id SERIAL PRIMARY KEY,
    quote TEXT NOT NULL,
    author_id INTEGER NOT NULL,
    category_id INTEGER NOT NULL,
    FOREIGN KEY (author_id) REFERENCES authors(id),
    FOREIGN KEY (category_id) REFERENCES categories(id)
);

INSERT INTO authors (author) VALUES
('Albert Einstein'),
('Maya Angelou'),
('Steve Jobs'),
('Oprah Winfrey'),
('Nelson Mandela'),
('Margaret Mead'),
('Bill Gates'),
('Malala Yousafzai'),
('Stephen Hawking'),
('Sheryl Sandberg');

INSERT INTO categories (category) VALUES
('Inspiration'),
('Success'),
('Wisdom'),
('Leadership');

INSERT INTO quotes (quote, author_id, category_id) VALUES
('Imagination is more important than knowledge.', 1, 1),
('There is no greater agony than bearing an untold story inside you.', 2, 3),
('The only way to do great work is to love what you do.', 3, 2),
('Turn your wounds into wisdom.', 4, 3),
('May your choices reflect your hopes, not your fears.', 5, 4),
('In the end, we will remember not the words of our enemies, but the silence of our friends.', 5, 4),
('Technology is best when it brings people together.', 7, 1),
('We realize the importance of our voices only when we are silenced.', 8, 1),
('Life would be tragic if it werent funny.', 9, 3),
('Done is better than perfect.', 10, 2);