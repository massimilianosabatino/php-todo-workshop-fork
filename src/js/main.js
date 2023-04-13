const { createApp } = Vue;

createApp({
    data(){
        return {
            apiUrl: 'server.php',
            todos: []
        }
    },
    methods: {
        //metodo per la lettura dei todos
        getTodos(){
            axios.get(this.apiUrl).then((response) => {
                console.log(response);
                this.todos = response.data;
            })
        }
    },
    created(){
        //lettura dei todos
        this.getTodos();
    }
}).mount('#app');
