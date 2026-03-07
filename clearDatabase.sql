-- Drop existing tables (in reverse order due to foreign key constraints)
DROP TABLE IF EXISTS public.quotes;
DROP TABLE IF EXISTS public.categories;
DROP TABLE IF EXISTS public.authors;

-- Create authors table
CREATE TABLE public.authors
(
    id SERIAL PRIMARY KEY,
    author VARCHAR(50) NOT NULL
);

-- Create categories table
CREATE TABLE public.categories
(
    id SERIAL PRIMARY KEY,
    category VARCHAR(20) NOT NULL
);

-- Create quotes table with foreign keys
CREATE TABLE public.quotes
(
    id SERIAL PRIMARY KEY,
    quote TEXT NOT NULL,
    author_id INTEGER NOT NULL,
    category_id INTEGER NOT NULL,
    FOREIGN KEY (author_id) REFERENCES authors(id),
    FOREIGN KEY (category_id) REFERENCES categories(id)
);

-- Insert sample data into authors
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
('Sheryl Sandberg'),
('Mark Twain'),
('Eleanor Roosevelt'),
('Winston Churchill'),
('Martin Luther King Jr.'),
('Marie Curie');

-- Insert sample data into categories
INSERT INTO categories (category) VALUES
('Inspiration'),
('Success'),
('Wisdom'),
('Leadership'),
('Courage'),
('Creativity'),
('Life');

-- Insert sample data into quotes
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
('Done is better than perfect.', 10, 2),
('The two most important days in your life are the day you are born and the day you find out why.', 11, 7),
('The future belongs to those who believe in the beauty of their dreams.', 12, 1),
('Success is not final, failure is not fatal: it is the courage to continue that counts.', 13, 5),
('The time is always right to do what is right.', 14, 4),
('Nothing in life is to be feared, it is only to be understood.', 15, 3),
('Life is what happens when youre busy making other plans.', 11, 7),
('Innovation distinguishes between a leader and a follower.', 3, 6),
('Education is the most powerful weapon which you can use to change the world.', 5, 4),
('The only impossible journey is the one you never begin.', 4, 2),
('Believe you can and youre halfway there.', 1, 1),
('I have learned over the years that when ones mind is made up, this diminishes fear.', 2, 5),
('Act as if what you do makes a difference. It does.', 12, 1),
('Success usually comes to those who are too busy to be looking for it.', 6, 2),
('The way to get started is to quit talking and begin doing.', 3, 2),
('Dont let yesterday take up too much of today.', 13, 3),
('You learn more from failure than from success.', 7, 3),
('Its not whether you get knocked down, its whether you get up.', 14, 5),
('We cannot solve problems with the kind of thinking we employed when we came up with them.', 1, 6),
('Learn as if you will live forever, live like you will die tomorrow.', 15, 7),
('When you change your thoughts, remember to also change your world.', 13, 1);