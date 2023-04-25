const { createApp } = Vue;

createApp({
    data(){
        return {
            apiUrl: 'server.php',
            todos: [],
            newToDo: '',

            // Form accesso
            logged: false,
            username: '',
            password: ''
        }
    },
    methods: {
        //metodo per la lettura dei todos
        getTodos(){
            const headers = {
                username: this.username
            };
            console.log('sent headers', headers)

            axios.get(this.apiUrl, { headers }).then((response) => {
                console.log(response);
                this.todos = response.data;
            })
        },
        //metodo per l'aggiunta dei todos
        addToDo(){
            console.log(this.newToDo);

            const data = {
                add: true,
                todo: this.newToDo,
                username: this.username
            };
            const headers = {
                'Content-Type': 'multipart/form-data',
                'Accept': 'application/json',
                username: this.username
            }
            axios.post(this.apiUrl, data, { headers }).then((response) => {
                console.log('addToDo response', response);
                this.todos = response.data;
            });
        },
        removeTodo(i) {
            console.log('Deleting todo on index', i);

            const data = {
                delete: i
            };
            const headers = {
                'Content-Type': 'multipart/form-data',
                'Accept': 'application/json',
                username: this.username
            }
            axios.post(this.apiUrl, data, { headers }).then((response) => {
                console.log('removeTodo response', response);
                this.todos = response.data;
            });
        },
        login() {
            const data = {
                action: 'login',
                username: this.username,
                password: this.password,
            };
            const headers = {
                'Content-Type': 'multipart/form-data',
                'Accept': 'application/json',
            }
            axios.post(this.apiUrl, data, { headers }).then((response) => {
                console.log('login response', response.data);
                if (response.data.username) {
                    this.logged = true;
                    this.getTodos();
                    //Create user in session storage
                    sessionStorage.setItem("log-status", true);
                    sessionStorage.setItem("user-logged", response.data.username);
                } else {
                    alert('Utente non trovato.');
                }
            })
        },
        logOut(){
            //User logout
            sessionStorage.clear();
            location.reload();
        }
    },
    created(){
        //Retrive user in session storage if present
        if (sessionStorage.getItem("log-status") === "true") {
            this.logged = sessionStorage.getItem("log-status");
            this.username = sessionStorage.getItem("user-logged");
        }
        this.getTodos();
        console.log('this.todos', this.todos);
    }
}).mount('#app');
