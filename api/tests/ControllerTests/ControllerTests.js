    window.addEventListener("load", () => {


        // Create an instance of axios and set the base URL
        const ax = axios.create({
            baseURL: 'http://localhost/api/'
        });

        // users
        document.getElementById("btnGetAllUsers").addEventListener("click", () => {
            ax.get("users/")
                .then(resp => {
                    console.log(resp);
                })
                .catch(err => {
                    console.log(err);
                });
        });

        document.getElementById("btnGetUserById").addEventListener("click", () => {
            ax.get("users/1")
                .then(resp => console.log(resp.data))
                .catch(err => console.log(err));
        });

        document.getElementById("btnPostUser").addEventListener("click", () => {

            const user = {
                user_first_name: "bill",
                user_last_name: "Smith",
                user_email: "bill@dfsdfffll.com",
                user_role: 1,
                user_password: "test",
                user_salt: "",
                user_active: "yes"
            };

            ax.post("users/", user)
                .then(resp => console.log(resp))
                .catch(err => console.log(err));
        });

        document.getElementById("btnPutUser").addEventListener("click", () => {
            const user = {
                id: 1,
                user_first_name: "Bill",
                user_last_name: "Joe",
                user_email: "Bil@ffaasfffffsldoe.com",
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
                .then(resp => {
                    console.log(resp);
                })
                .catch(err => {
                    console.log(err);
                });
        });

        document.getElementById("btnGetProductById").addEventListener("click", () => {
            ax.get("products/1")
                .then(resp => console.log(resp.data))
                .catch(err => console.log(err));
        });

        document.getElementById("btnPostProduct").addEventListener("click", () => {

            const product = {
                product_name: "producttttt",
                product_desc: "desccription",
                product_price: 11,
                type_id: 1,
                active: "yes"
            };

            ax.post("products/", product)
                .then(resp => console.log(resp))
                .catch(err => console.log(err));
        });

        document.getElementById("btnPutProduct").addEventListener("click", () => {
            const product = {
                id: 1,
                product_name: "producttttt",
                product_desc: "desccription",
                product_price: 11,
                type_id: 1,
                active: "yes"
            };
            ax.put(`products/${product.id}`, product)
                .then(resp => console.log(resp))
                .catch(err => console.log(err));
        });

        document.getElementById("btnDeleteProduct").addEventListener("click", () => {
            const productId = 1;
            ax.delete(`products/${productId}`).then(resp => console.log(resp)).catch(err => console.log(err));
        });

        // departments
        document.getElementById("btnGetAllDepartments").addEventListener("click", () => {
            ax.get("departments/")
                .then(resp => {
                    console.log(resp);
                })
                .catch(err => {
                    console.log(err);
                });
        });

        document.getElementById("btnGetDepartmentById").addEventListener("click", () => {
            ax.get("departments/1")
                .then(resp => console.log(resp.data))
                .catch(err => console.log(err));
        });

        document.getElementById("btnPostDepartment").addEventListener("click", () => {

            const department = {
                department_name: "spooooooon",
                department_staff_count: 2,
                employee_id: 1,
                active: "yes"
            };

            ax.post("departments/", department)
                .then(resp => console.log(resp))
                .catch(err => console.log(err));
        });

        document.getElementById("btnPutDepartment").addEventListener("click", () => {
            const department = {
                id: 1,
                department_name: "Bilzasdfl",
                department_staff_count: 222,
                employee_id: 2,
                active: "yes"
            };
            ax.put(`departments/${department.id}`, department)
                .then(resp => console.log(resp))
                .catch(err => console.log(err));
        });
        document.getElementById("btnDeleteDepartment").addEventListener("click", () => {
            const departmentId = 1;
            ax.delete(`departments/${departmentId}`).then(resp => console.log(resp)).catch(err => console.log(err));
        });

        // employees
        document.getElementById("btnGetAllEmployees").addEventListener("click", () => {
            ax.get("employees/")
                .then(resp => {
                    console.log(resp);
                })
                .catch(err => {
                    console.log(err);
                });
        });

        document.getElementById("btnGetEmployeeById").addEventListener("click", () => {
            ax.get("employees/1")
                .then(resp => console.log(resp.data))
                .catch(err => console.log(err));
        });

        document.getElementById("btnPostEmployee").addEventListener("click", () => {

            const Employee = {
                id: 3,
                user_id: 4,
                employee_dob: "2001-01-01",
                employee_salary: 22,
                employee_part_time: "yes",
                active: "yes"
            };

            ax.post("employees/", Employee)
                .then(resp => console.log(resp))
                .catch(err => console.log(err));
        });

        document.getElementById("btnPutEmployee").addEventListener("click", () => {
            const Employee = {
                id: 1,
                user_id: 1,
                employee_dob: "2001-01-01",
                employee_salary: 22,
                employee_part_time: "yes",
                active: "yes"
            };
            ax.put(`employees/${Employee.id}`, Employee)
                .then(resp => console.log(resp))
                .catch(err => console.log(err));
        });
        document.getElementById("btnDeleteEmployee").addEventListener("click", () => {
            const employeeId = 1;
            ax.delete(`employees/${employeeId}`).then(resp => console.log(resp)).catch(err => console.log(err));
        });

    // Roles
    document.getElementById("btnGetAllRoles").addEventListener("click", () => {
        ax.get("roles/")
            .then(resp => {
                console.log(resp);
            })
            .catch(err => {
                console.log(err);
            });
    });

    document.getElementById("btnGetRoleById").addEventListener("click", () => {
        ax.get("roles/1")
            .then(resp => console.log(resp.data))
            .catch(err => console.log(err));
    });

    document.getElementById("btnPostRole").addEventListener("click", () => {

        const Role = {
            role_name: "bbbbbbxxxxxx",
            role_desc: "bbbbbbbeeeeee",
            active: "yes"
        };

        ax.post("roles/", Role)
            .then(resp => console.log(resp))
            .catch(err => console.log(err));
    });

    document.getElementById("btnPutRole").addEventListener("click", () => {
        const Role = {
            id: 1,
            role_name: "flaje",
            role_desc: "beeeeeeeflkj",
            active: "yes"
        };
        ax.put(`roles/${Role.id}`, Role)
            .then(resp => console.log(resp))
            .catch(err => console.log(err));
    });

    document.getElementById("btnDeleteRole").addEventListener("click", () => {
        const roleId = 1;
        ax.delete(`roles/${roleId}`).then(resp => console.log(resp)).catch(err => console.log(err));
    });

    //Product Types
    document.getElementById("btnGetAllProductTypes").addEventListener("click", () => {
        ax.get("productTypes/")
            .then(resp => {
                console.log(resp);
            })
            .catch(err => {
                console.log(err);
            });
    });

    document.getElementById("btnGetProductTypeById").addEventListener("click", () => {
        ax.get("productTypes/1")
            .then(resp => console.log(resp.data))
            .catch(err => console.log(err));
    });

    document.getElementById("btnPostProductType").addEventListener("click", () => {

        const productType = {
            product_type_name: "bbbbbbxxxxxx",
            product_type_desc: "bbbbbbbeeeeee",
            active: "yes"
        };

        ax.post("productTypes/", productType)
            .then(resp => console.log(resp))
            .catch(err => console.log(err));
    });

    document.getElementById("btnPutProductType").addEventListener("click", () => {
        const productType = {
            id: 1,
            product_type_name: "flaje",
            product_type_desc: "beeeeeeeflkj",
            active: "yes"
        };
        ax.put(`productTypes/${productType.id}`, productType)
            .then(resp => console.log(resp))
            .catch(err => console.log(err));
    });

    document.getElementById("btnDeleteProductType").addEventListener("click", () => {
        const productTypeId = 1;
        ax.delete(`productTypes/${productTypeId}`).then(resp => console.log(resp)).catch(err => console.log(err));
    });

    // Images
    document.getElementById('btnPostImage').addEventListener("click", () => {
        const image = {
            product_id: 1,
            path: 'somepath',
            active: 'yes'
        }
        ax.post("images/", image)
            .then(resp => console.log(resp))
            .catch(err => console.log(err));
    });

    document.getElementById('btnPutImage').addEventListener("click", () => {
        const image = {
            id: 1,
            product_id: 2,
            path: 'somepathupdate',
            active: 'yes'
        }
        ax.put(`images/${image.id}`, image)
            .then(resp => console.log(resp))
            .catch(err => console.log(err));
    });

    document.getElementById('btnDeleteImage').addEventListener('click', () => {
        const id = 6;
        ax.delete(`images/${id}`)
            .then(resp => console.log(resp))
            .catch(err => console.log(err));
    });

});