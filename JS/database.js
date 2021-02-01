/*
1. A way of storing data
2. Javascript object notation
3. I believe everything is identical to building js objects
   besides the "keys" in json must be strings-> written in double quotes
4. It brings the benefit of using objects. Meaning that one can sort through large files the same way one would sort through an object. 
In addition, it formats well for heiretical data and can be expanded well. 
*/
const database = 
{
    "Employees": [
        {
            "name": "Nicholas Nicholason", 
            "DOB": "01/01/2001",
            "email": "something@something.com",
            "department": "somewhere",
            "salary": 25,
            "partTime": true
        },
        {
            "name": "Michael Michaelson", 
            "DOB": "01/01/2002",
            "email": "something1@something.com",
            "department": "somewhereelse",
            "Salary": 4,
            "partTime": false
        },
        {
            "name": "John Johnson", 
            "DOB": "01/01/2003",
            "email": "something2@something.com",
            "department": "somewhereother",
            "salary": 35,
            "partTime": false
        }
    ],
    "Department": [
        {
            "name": "somewhere",
            "staffCount": 25,
            "manager": "Nicholas Heraz"
        },
        {
            "name": "somewhereelse",
            "staffCount": 18,
            "manager": "Michael Michaelson"
        },
        {
            "name": "somewhereother",
            "staffCount": 20,
            "manager": "John Johnson"
        },
    ],~
    "Products": [
        {
            "name": "A glorious product name",
            "price": 55,
            "desc": "the best product"
        },
        {
            "name": "An even better product", 
            "price": 35,
            "desc": "Might possibly be better..."
        },
        {
            "name": "Surely this product can't be better than the last",
            "price": 999999,
            "desc": "it is better... buy this one"
        }
    ]
};

const { Employees, Products, Department } = database;