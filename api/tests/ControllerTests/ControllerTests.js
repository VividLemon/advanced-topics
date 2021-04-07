    window.addEventListener("load", () => {


        // Create an instance of axios and set the base URL
        const ax = axios.create({
            baseURL: 'http://localhost/api/'
        });

        // users
        document.getElementById("btnGetAllUsers").addEventListener("click", () => {
            ax.get("users/")
                .then(response => {
                    console.log(response);
                })
                .catch(err => {
                    console.log(err);
                });
        });

        document.getElementById("btnGetUserById").addEventListener("click", () => {
            ax.get("users/1")
                .then(response => console.log(response.data))
                .catch(err => console.log(err));
        });

        document.getElementById("btnPostUser").addEventListener("click", () => {

            const user = {
                user_first_name: "bill",
                user_last_name: "Smith",
                user_email: "bill@bifffll.com",
                user_role: 1,
                user_password: "test",
                user_salt: "",
                user_active: "yes"
            };

            ax.post("users/", user)
                .then(response => console.log(response))
                .catch(error => console.log(error));
        });

        document.getElementById("btnPutUser").addEventListener("click", () => {
            const user = {
                id: 1,
                user_first_name: "Bill",
                user_last_name: "Joe",
                user_email: "Bil@ffaasffsldoe.com",
                user_role: 1,
                user_password: "test",
                user_salt: "",
                user_active: "yes"
            };
            ax.put(`users/${user.id}`, user)
                .then(resp => console.log(resp))
                .catch(err => console.log(err));
        });

        document.getElementById("btnDeleteUser").addEventListener("click", () => {
            const userId = 1;
            ax.delete(`users/${userId}`).then(resp => console.log(resp)).catch(err => console.log(err));
        });

        // products
        document.getElementById("btnGetAllProducts").addEventListener("click", () => {
            ax.get("products/")
                .then(response => {
                    console.log(response);
                })
                .catch(err => {
                    console.log(err);
                });
        });

        document.getElementById("btnGetProductById").addEventListener("click", () => {
            ax.get("products/1")
                .then(response => console.log(response.data))
                .catch(err => console.log(err));
        });

        document.getElementById("btnPostProduct").addEventListener("click", () => {

            const product = {
                product_name: "producttttt",
                product_desc: "desccription",
                product_price: 11,
                type_id: 1,
            };

            ax.post("products/", product)
                .then(response => console.log(response))
                .catch(error => console.log(error));
        });

        document.getElementById("btnPutProduct").addEventListener("click", () => {
            const product = {
                id: 1,
                product_name: "producttttt",
                product_desc: "desccription",
                product_price: 11,
                type_id: 1
            };
            ax.put(`products/${product.id}`, product)
                .then(resp => console.log(resp))
                .catch(err => console.log(err));
        });

        // departments
        document.getElementById("btnGetAllDepartments").addEventListener("click", () => {
            ax.get("departments/")
                .then(response => {
                    console.log(response);
                })
                .catch(err => {
                    console.log(err);
                });
        });

        document.getElementById("btnGetDepartmentById").addEventListener("click", () => {
            ax.get("departments/1")
                .then(response => console.log(response.data))
                .catch(err => console.log(err));
        });

        document.getElementById("btnPostDepartment").addEventListener("click", () => {

            const department = {
                department_name: "spooooooon",
                department_staff_count: 2,
                employee_id: 1
            };

            ax.post("departments/", department)
                .then(response => console.log(response))
                .catch(error => console.log(error));
        });

        document.getElementById("btnPutDepartment").addEventListener("click", () => {
            const department = {
                id: 1,
                department_name: "Bilzasdfl",
                department_staff_count: 222,
                employee_id: 2
            };
            ax.put(`departments/${department.id}`, department)
                .then(resp => console.log(resp))
                .catch(err => console.log(err));
        });

        // employees
        document.getElementById("btnGetAllEmployees").addEventListener("click", () => {
            ax.get("employees/")
                .then(response => {
                    console.log(response);
                })
                .catch(err => {
                    console.log(err);
                });
        });

        document.getElementById("btnGetEmployeeById").addEventListener("click", () => {
            ax.get("employees/1")
                .then(response => console.log(response.data))
                .catch(err => console.log(err));
        });

        document.getElementById("btnPostEmployee").addEventListener("click", () => {

            const Employee = {
                id: 3,
                user_id: 4,
                employee_dob: "2001-01-01",
                employee_salary: 22,
                employee_part_time: "yes"
            };

            ax.post("employees/", Employee)
                .then(response => console.log(response))
                .catch(error => console.log(error));
        });

        document.getElementById("btnPutEmployee").addEventListener("click", () => {
            const Employee = {
                id: 1,
                user_id: 1,
                employee_dob: "2001-01-01",
                employee_salary: 22,
                employee_part_time: "yes"
            };
            ax.put(`employees/${Employee.id}`, Employee)
                .then(resp => console.log(resp))
                .catch(err => console.log(err));
        });

    // Roles
    document.getElementById("btnGetAllRoles").addEventListener("click", () => {
        ax.get("roles/")
            .then(response => {
                console.log(response);
            })
            .catch(err => {
                console.log(err);
            });
    });

    document.getElementById("btnGetRoleById").addEventListener("click", () => {
        ax.get("roles/1")
            .then(response => console.log(response.data))
            .catch(err => console.log(err));
    });

    document.getElementById("btnPostRole").addEventListener("click", () => {

        const Role = {
            role_name: "bbbbbbxxxxxx",
            role_desc: "bbbbbbbeeeeee"
        };

        ax.post("roles/", Role)
            .then(response => console.log(response))
            .catch(error => console.log(error));
    });

    document.getElementById("btnPutRole").addEventListener("click", () => {
        const Role = {
            id: 1,
            role_name: "flaje",
            role_desc: "beeeeeeeflkj"
        };
        ax.put(`roles/${Role.id}`, Role)
            .then(resp => console.log(resp))
            .catch(err => console.log(err));
    });

});