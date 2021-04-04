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
                firstName: "bill",
                lastName: "Smith",
                email: "bill@bill.com",
                roleId: 1,
                password: "test",
                active: "yes"
            };

            ax.post("users/", user)
                .then(response => console.log(response))
                .catch(error => console.log(error));
        });

        document.getElementById("btnPutUser").addEventListener("click", () => {
            const user = {
                id: 1,
                firstName: "Bill",
                lastName: "Joe",
                email: "Bil@ffaasffsldoe.com",
                roleId: 1,
                password: "test",
                active: "yes"
            };
            ax.put(`users/${user.id}`, user)
                .then(resp => console.log(resp))
                .catch(err => console.log(err));
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
                firstName: "bill",
                lastName: "Smith",
                email: "bill@bill.com",
                roleId: 1,
                password: "test",
                active: "yes"
            };

            ax.post("products/", product)
                .then(response => console.log(response))
                .catch(error => console.log(error));
        });

        document.getElementById("btnPutProduct").addEventListener("click", () => {
            const product = {
                id: 1,
                firstName: "Bill",
                lastName: "Joe",
                email: "Bil@ffaasffsldoe.com",
                roleId: 1,
                password: "test",
                active: "yes"
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
                firstName: "bill",
                lastName: "Smith",
                email: "bill@bill.com",
                roleId: 1,
                password: "test",
                active: "yes"
            };

            ax.post("departments/", department)
                .then(response => console.log(response))
                .catch(error => console.log(error));
        });

        document.getElementById("btnPutDepartment").addEventListener("click", () => {
            const department = {
                id: 1,
                firstName: "Bill",
                lastName: "Joe",
                email: "Bil@ffaasffsldoe.com",
                roleId: 1,
                password: "test",
                active: "yes"
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
                firstName: "bill",
                lastName: "Smith",
                email: "bill@bill.com",
                roleId: 1,
                password: "test",
                active: "yes"
            };

            ax.post("employees/", Employee)
                .then(response => console.log(response))
                .catch(error => console.log(error));
        });

        document.getElementById("btnPutEmployee").addEventListener("click", () => {
            const Employee = {
                id: 1,
                firstName: "Bill",
                lastName: "Joe",
                email: "Bil@ffaasffsldoe.com",
                roleId: 1,
                password: "test",
                active: "yes"
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
            firstName: "bill",
            lastName: "Smith",
            email: "bill@bill.com",
            roleId: 1,
            password: "test",
            active: "yes"
        };

        ax.post("roles/", Role)
            .then(response => console.log(response))
            .catch(error => console.log(error));
    });

    document.getElementById("btnPutRole").addEventListener("click", () => {
        const Role = {
            id: 1,
            firstName: "Bill",
            lastName: "Joe",
            email: "Bil@ffaasffsldoe.com",
            roleId: 1,
            password: "test",
            active: "yes"
        };
        ax.put(`roles/${Role.id}`, Role)
            .then(resp => console.log(resp))
            .catch(err => console.log(err));
    });

});