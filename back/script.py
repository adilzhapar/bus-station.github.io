import mysql.connector

conn_object=mysql.connector.connect(host='localhost',user='adil',password='jukilo999',database='webMKM')

cur = conn_object.cursor()

# query  = 'CREATE TABLE example(id VARCHAR(12))'
# query2 = 'INSERT INTO example VALUES(1234)'
# query3 = 'SELECT * FROM example'


users_query = '''CREATE TABLE users(
    username VARCHAR(100) PRIMARY KEY,
    pass VARCHAR(100),
    birthday DATE,
    firstName VARCHAR(50),
    lastName VARCHAR(50),
    creditCard VARCHAR(16),
    numberOfOrders INT
)'''

orders_query = '''CREATE TABLE orders(
    order_id INT NOT NULL AUTO_INCREMENT,
    username VARCHAR(100) NOT NULL,
    ticket_id INT NOT NULL,
    isTwoWay BOOLEAN,
    busType VARCHAR(20),
    vip BOOLEAN,
    discount int,
    amount int,
    finalPrice INT,
    isActive BOOLEAN,
    PRIMARY KEY (order_id),
    FOREIGN KEY (username) REFERENCES users(username) ON DELETE CASCADE,
    FOREIGN KEY (ticket_id) REFERENCES tickets(ticket_id) ON DELETE CASCADE
)'''


tickets_query = '''CREATE TABLE tickets(
    ticket_id int NOT NULL,
    cityA VARCHAR(30),
    cityB VARCHAR(30),
    departure DATE,
    arrival DATE,
    cost int,
    PRIMARY KEY (ticket_id)
)'''

cur.execute(orders_query)

conn_object.commit()



cur.close()
conn_object.close()


