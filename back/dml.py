import mysql.connector

conn_object=mysql.connector.connect(host='localhost',user='adil',password='jukilo999',database='webMKM')

cur = conn_object.cursor()

users_query = """INSERT INTO users VALUES(
    'zhaparka', 'zhaparka', '2002-08-13', 'Adil', 'Zhapar', NULL, 0)"""

tickets_query = """INSERT INTO tickets VALUES
(0, 'Almaty', 'Astana', '2022-11-29', '2022-12-01', 13000)"""

orders_query = """INSERT INTO orders VALUES(
    default, 'zhaparka', 0, TRUE, 'jeep', TRUE, 0, 1, 35000, TRUE)"""
orders_query2 = """INSERT INTO orders VALUES(
    default, 'zhaparka', 0, FALSE, 'cargo', FALSE, 0, 1, 26000, TRUE)"""

cur.execute(orders_query)
cur.execute(orders_query2)

conn_object.commit()



cur.close()
conn_object.close()


