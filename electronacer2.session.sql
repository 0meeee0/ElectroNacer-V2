USE electronacer2;
--@block
CREATE TABLE user(
    identifiant INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) unique,
    email VARCHAR(50) unique,
    pass VARCHAR(50) not null,
    bl BOOLEAN DEFAULT FALSE
);

--@block
CREATE TABLE admin(
    identifiant VARCHAR(50) unique not null,
    email VARCHAR(50),
    pass VARCHAR(50) not null
);

--@block
CREATE TABLE category(
    name INT,
    description TEXT NOT NULL,
    pic VARCHAR(255) NOT NULL
)

--@block
INSERT INTO admin (identifiant, email, pass) VALUES ("mehdi", "mehdi74.id@gmail.com", "123");
--@block
INSERT INTO user (identifiant, username, email, pass, bl) VALUES (1, "user", "user@user.com", "123", true);


--@block
CREATE TABLE Products (
    Reference VARCHAR(255) NOT NULL, 
    Image VARCHAR(255) NOT NULL, 
    Barcode VARCHAR(255) NOT NULL,
    Label VARCHAR(255) NOT NULL, 
    PurchasePrice DECIMAL(10, 2) NOT NULL, 
    FinalPrice DECIMAL(10, 2) NOT NULL, 
    PriceOffer VARCHAR(255) NOT NULL, 
    Description TEXT NOT NULL, 
    MinQuantity INT NOT NULL, 
    StockQuantity INT NOT NULL,
    Category VARCHAR(255) NOT NULL
);


--@block
INSERT INTO admin(identifiant, email, pass) VALUES 
('mehdi', 'mehdi74.id@gmail.com', '123')


--@block
INSERT INTO Products(
    Reference,
    Image,
    Barcode,
    Label,
    PurchasePrice,
    FinalPrice,
    PriceOffer,
    Description,
    MinQuantity,
    StockQuantity,
    Category
) VALUES(
    '1',
    'imgs/a1.jpg',
    '0000',
    'Lenovo Laptop 1',
    5000,
    9000,
    8000,
    'laptop bonne état',
    5,
    12,
    'laptops'
),(
    '2',
    'imgs/a2.jpg',
    '0000',
    'Lenovo Laptop 2',
    5000,
    9500,
    9000,
    'laptop bonne état',
    5,
    4,
    'laptops'
),(
    '3',
    'imgs/a3.jpg',
    '0000',
    'Lenovo Laptop 3',
    5000,
    8900,
    8000,
    'laptop bonne état',
    5,
    15,
    'laptops'
),(
    '4',
    'imgs/a4.jpg',
    '0000',
    'Lenovo Laptop 4',
    5000,
    8800,
    7000,
    'laptop bonne état',
    5,
    1,
    'laptops'
),(
    '5',
    'imgs/b1.jpg',
    '0000',
    'Phone 1',
    500,
    1300,
    1000,
    'Phone bonne état',
    5,
    3,
    'phones'
),(
    '6',
    'imgs/b2.jpg',
    '0000',
    'Phone 1',
    500,
    1400,
    1000,
    'Phone bonne état',
    5,
    3,
    'phones'
),(
    '7',
    'imgs/b3.jpg',
    '0000',
    'Phone 3',
    1000,
    2100,
    2000,
    'Phone bonne état',
    5,
    3,
    'phones'
),(
    '8',
    'imgs/b4.jpg',
    '0000',
    'Phone 4',
    2000,
    3000,
    2000,
    'Phone bonne état',
    5,
    10,
    'phones'
),(
    '9',
    'imgs/c1.jpg',
    '0000',
    'Refrigerateur 1',
    10000,
    18900,
    15000,
    'Refrigerateur bonne état',
    5,
    6,
    'electromenager'
),(
    '10',
    'imgs/c2.jpg',
    '0000',
    'Pack 1',
    10000,
    30000,
    26000,
    'Refrigerateur bonne état',
    5,
    1,
    'electromenager'
),(
    '11',
    'imgs/c3.jpg',
    '0000',
    'Pack 2',
    12000,
    31000,
    25000,
    'Refrigerateur bonne état',
    5,
    2,
    'electromenager'
),(
    '12',
    'imgs/c4.jpg',
    '0000',
    'Lave-vaisselle',
    2000,
    4000,
    3000,
    'Lave-vaisselle bonne état',
    5,
    99,
    'electromenager'
),(
    '13',
    'imgs/d1.jpg',
    '0000',
    'PlayStation 5',
    500,
    2,
    2,
    'PlayStation 5 bonne état',
    5,
    1,
    'consoles'
),
(
    '14',
    'imgs/d2.jpg',
    '0000',
    'PS5 Controller',
    200,
    600,
    555,
    'Manetta bonne état',
    5,
    20,
    'consoles'
),
(
    '15',
    'imgs/d3.jpg',
    '0000',
    'Xbox One',
    500,
    2,
    2,
    'Xbox bonne état',
    5,
    1,
    'consoles'
)