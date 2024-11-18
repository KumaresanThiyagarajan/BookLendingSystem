import mysql.connector
from mysql.connector import Error

def connect_to_database():
    try:
        # Replace with your database credentials
        connection = mysql.connector.connect(
            host="localhost",        # Database host
            user="your_username",    # Your database username
            password="your_password",# Your database password
            database="book_lending_system"  # Database name
        )

        if connection.is_connected():
            print("Successfully connected to the database")
            return connection

    except Error as e:
        print(f"Error while connecting to MySQL: {e}")
        return None

def fetch_lending_records():
    connection = connect_to_database()
    if connection:
        try:
            cursor = connection.cursor(dictionary=True)
            query = "SELECT * FROM lending"
            cursor.execute(query)
            records = cursor.fetchall()
            return records

        except Error as e:
            print(f"Error while fetching records: {e}")
            return []

        finally:
            cursor.close()
            connection.close()

def add_lending_record(data):
    connection = connect_to_database()
    if connection:
        try:
            cursor = connection.cursor()
            query = """
                INSERT INTO lending (book_name, author_name, lender_name, department, year_of_study, lending_date)
                VALUES (%s, %s, %s, %s, %s, %s)
            """
            cursor.execute(query, (
                data['book_name'], 
                data['author_name'], 
                data['lender_name'], 
                data['department'], 
                data['year_of_study'], 
                data['lending_date']
            ))
            connection.commit()
            print("Record added successfully.")

        except Error as e:
            print(f"Error while adding record: {e}")

        finally:
            cursor.close()
            connection.close()

if __name__ == "__main__":
    # Example: Fetch all lending records
    print("Fetching lending records...")
    records = fetch_lending_records()
    for record in records:
        print(record)

    # Example: Add a new lending record
    print("Adding a new lending record...")
    new_record = {
        "book_name": "Python Programming",
        "author_name": "John Doe",
        "lender_name": "Jane Smith",
        "department": "Computer Science",
        "year_of_study": "3rd Year",
        "lending_date": "2024-11-18"
    }
    add_lending_record(new_record)
