const { createApp } = Vue;

createApp({
    data(){
        return {
            apiUrl: 'server.php',
            todos: [],
            newToDo: '',
        }
    },
    methods: {
        //metodo per la lettura dei todos
        getTodos(){
            axios.get(this.apiUrl).then((response) => {
                console.log(response);
                this.todos = response.data;
            })
        },
        //metodo per l'aggiunta dei todos
        addToDo(){
            console.log(this.newToDo);

            const data = {
                //...
            }
        }
    },
    created(){
        //lettura dei todos
        this.getTodos();
    }
}).mount('#app');
