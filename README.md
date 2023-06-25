# Doctor Record Management System using Bplus-Tree
This is a website that allows user to add doctor details, remove doctor details, search doctor details and view the B+ Tree formed using the UID of Doctors. The data is stored in a data file named data.txt. The deleted records have a (#) symbol at the beginning of the record.
B+ Tree is an extension of B Tree which allows efficient insertion, deletion and search operations. The leaf nodes of a B+ tree are linked together in the form of a singly linked lists to make the search queries more efficient.B+ Tree are used to store the large amount of data which can not be stored in the main memory. Due to the fact that, size of main memory is always limited, the internal nodes (keys to access records) of the B+ tree are stored in the main memory whereas, leaf nodes are stored in the secondary memory.
## Authors

[Jessica Bhagtani](https://github.com/J-12345)

## Installation

Download and install XAMPP from the [Website](https://www.apachefriends.org/download.html).

## Usage

Go to the location where XAMPP is installed, and inside the "htdocs" folder.\
Clone this repository at the above location in your local machine using the command-
```bash
git clone https://github.com/J-12345/Blood-Donation-Management-System.git
```
Open XAMPP Control Panel and start running Apache and MySQL.\
Open any web browser and go to the following URL - [http://localhost/bdms/](http://localhost//index.html) to view the website.
## Screenshots
<img src="https://github.com/J-12345/Bplus-Tree-Implementation/blob/main/Screenshots/home.jpg">
<img src="https://github.com/J-12345/Bplus-Tree-Implementation/blob/main/Screenshots/b%2Btree.jpg">
<img src="https://github.com/J-12345/Bplus-Tree-Implementation/blob/main/Screenshots/doctor-add-details.jpg">
<img src="https://github.com/J-12345/Bplus-Tree-Implementation/blob/main/Screenshots/search.jpg">
<img src="https://github.com/J-12345/Bplus-Tree-Implementation/blob/main/Screenshots/delete.jpg">
