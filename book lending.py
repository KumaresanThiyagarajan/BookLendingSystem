import tkinter as tk
from tkinter import messagebox, ttk
from datetime import datetime, timedelta

# List to store book records
books = []

# Function to add a book
def add_book():
    title = title_entry.get()
    author = author_entry.get()
    status = status_entry.get()
    student_name = student_name_entry.get()
    department = department_entry.get()
    
    if title and author and status and student_name and department:
        if status.lower() == "lent":
            due_date = (datetime.now() + timedelta(days=30)).strftime('%Y-%m-%d')
        else:
            due_date = "N/A"
        
        books.append({
            "Title": title, 
            "Author": author, 
            "Date of Lending": status, 
            "Student": student_name,
            "Department": department,
            "Due Date": due_date
        })
        messagebox.showinfo("Success", "Book added successfully!")
        display_books()
    else:
        messagebox.showwarning("Input Error", "Please fill all fields")
    
    # Clear input fields
    title_entry.delete(0, tk.END)
    author_entry.delete(0, tk.END)
    status_entry.delete(0, tk.END)
    student_name_entry.delete(0, tk.END)
    department_entry.delete(0, tk.END)

# Function to display books
def display_books():
    # Clear the tree view first
    for row in tree.get_children():
        tree.delete(row)
    
    # Insert each book record into the tree view
    for idx, book in enumerate(books):
        tree.insert("", "end", values=(
            idx + 1, book["Title"], book["Author"], book["Date of Lending"], book["Student"], book["Department"], book["Due Date"]
        ))

# Function to update a book
def update_book():
    try:
        selected_item = tree.selection()[0]
        book_index = int(tree.item(selected_item)["values"][0]) - 1
        
        new_title = title_entry.get()
        new_author = author_entry.get()
        new_status = status_entry.get()
        new_student = student_name_entry.get()
        new_department = department_entry.get()
        
        if new_title and new_author and new_status and new_student and new_department:
            if new_status.lower() == "lent":
                due_date = (datetime.now() + timedelta(days=30)).strftime('%Y-%m-%d')
            else:
                due_date = "N/A"
            
            books[book_index].update({
                "Title": new_title,
                "Author": new_author,
                "Date of Lending": new_status,
                "Student": new_student,
                "Department": new_department,
                "Due Date": due_date
            })
            messagebox.showinfo("Success", "Book updated successfully!")
            display_books()
        else:
            messagebox.showwarning("Input Error", "Please fill all fields")
    except IndexError:
        messagebox.showwarning("Selection Error", "Please select a book to update")

# Function to delete a book
def delete_book():
    try:
        selected_item = tree.selection()[0]
        book_index = int(tree.item(selected_item)["values"][0]) - 1
        books.pop(book_index)
        messagebox.showinfo("Success", "Book deleted successfully!")
        display_books()
    except IndexError:
        messagebox.showwarning("Selection Error", "Please select a book to delete")

# Setting up the main Tkinter window
root = tk.Tk()
root.title("Book Lending System")

# Labels and Entry fields for book details
tk.Label(root, text="Title:").grid(row=0, column=0)
title_entry = tk.Entry(root)
title_entry.grid(row=0, column=1)

tk.Label(root, text="Author:").grid(row=1, column=0)
author_entry = tk.Entry(root)
author_entry.grid(row=1, column=1)

tk.Label(root, text="Date of Lending:").grid(row=2, column=0)
status_entry = tk.Entry(root)
status_entry.grid(row=2, column=1)

tk.Label(root, text="Student Name:").grid(row=3, column=0)
student_name_entry = tk.Entry(root)
student_name_entry.grid(row=3, column=1)

tk.Label(root, text="Department:").grid(row=4, column=0)
department_entry = tk.Entry(root)
department_entry.grid(row=4, column=1)

# Buttons for CRUD operations
add_button = tk.Button(root, text="Add Book", command=add_book)
add_button.grid(row=5, column=0)

update_button = tk.Button(root, text="Update Book", command=update_book)
update_button.grid(row=5, column=1)

delete_button = tk.Button(root, text="Delete Book", command=delete_book)
delete_button.grid(row=5, column=2)

# Treeview widget to display books
tree = ttk.Treeview(root, columns=("ID", "Title", "Author", "Date of Lending", "Student", "Department", "Due Date"), show='headings')
tree.heading("ID", text="ID")
tree.heading("Title", text="Title")
tree.heading("Author", text="Author")
tree.heading("Status", text="Status")
tree.heading("Student", text="Student")
tree.heading("Department", text="Department")
tree.heading("Due Date", text="Due Date")
tree.grid(row=6, column=0, columnspan=3)

# Display the main window
root.mainloop()
