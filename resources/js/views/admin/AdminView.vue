<template>
    <div class="w-100 d-flex justify-center">
        <v-card class="bg-transparent text-pink-lighten-4 w-75">
            <v-tabs
                class="w-100 ml-2 text-center"
                v-model="tab"
                bg-color="transparent"
                >
                <v-tab value="one">Категории</v-tab>
                <v-tab value="two">Пользователи</v-tab>
            </v-tabs>
        <v-card-text>
        <v-window v-model="tab">
            <v-window-item value="one">
                <div class="d-flex w-75 justify-space-between mt-12">
                    <v-text-field label="Добавьте категорию" v-model="category" class="mr-16" variant="underlined"></v-text-field>
                    <v-btn variant="outlined" class="w-25" @click.prevent="add_categoty">Добавить</v-btn>
                </div>
                <v-table id="myTable" theme="dark" class="w-75 mt-10" :search="search"  :headers="headers">
                    <thead>
                        <v-card-title>
                        Поиск
                        <v-spacer></v-spacer>
                        <v-text-field
                            v-model="search"
                            append-icon="mdi-magnify"
                            label="Search"
                            single-line
                            hide-details
                            @keyup="this.search_tables()"
                        ></v-text-field>
                        </v-card-title>
                    <tr>
                        <th class="text-left">
                        id
                        </th>
                        <th class="text-left">
                        Категории
                        </th>
                        <th class="text-center">
                        
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr
                        v-for="category in categories"
                        :key="category">
                        <td>{{ category.id }}</td>
                        <td>{{ category.category }}</td>
                        <td class="py-2"><v-btn
                            variant="outlined"
                            icon
                            color="error"
                            v-if="category.category != 'Все посты'"
                            @click.prevent="delete_category(category.id)"
                            >
                            <v-icon>mdi-trash-can</v-icon>
                        </v-btn></td>
                    </tr>
                    </tbody>
                </v-table>
            </v-window-item>

            <v-window-item value="two">
                <v-table theme="dark" class="w-75 mt-10">
                    <thead>
                    <tr>
                        <th class="text-left">
                        id
                        </th>
                        <th class="text-left">
                        Пользователи
                        </th>
                        <th class="text-left">
                        Бан
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr
                        v-for="user in users"
                        :key="user">
                        <td>{{ user.id }}</td>
                        <td>{{ user.name + " " + user.surname }}</td>
                        <td class="py-2" v-if="user.role == 0 || user.role == 1"><v-btn
                            variant="outlined"
                            icon
                            color="error"
                            @click.prevent="user_ban(user.id)"
                            >
                            <v-icon>mdi-cancel</v-icon>
                        </v-btn></td>
                        <td v-else class="py-2"><v-btn
                            variant="outlined"
                            icon
                            color="success"
                            @click.prevent="user_unban(user.id)"
                            >
                            <v-icon>mdi-account-check-outline</v-icon>
                        </v-btn></td>
                    </tr>
                    </tbody>
                </v-table>
            </v-window-item>
        </v-window>
        </v-card-text>
        </v-card>
    </div>
</template>

<script>
export default {
    data () {
        return {
            tab: null,
            search: '',
            users: [],
            categories: [],
            category: '',
        }
    },
    mounted() {
        document.title = "Админка";
        this.all_users();
        this.all_category();
    },
   
    methods: {
        search_tables() {
            let words = [];
            console.log(this.search)
            for(let i = 0; this.categories.length > i; i++){
                words[i] = (this.categories[i]['category'])
            }
            let filter = this.search.toUpperCase();
            let table = document.getElementById("myTable");
            let tr = table.getElementsByTagName("tr");
            for (let i = 0; i < tr.length; i++) {
                let td = tr[i].getElementsByTagName("td")[1];
                if (td) {
                let txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
                }
            }
            // this.categories = this.filterItems(words, this.search);
            // console.log(this.categories);
            // let categories_two = this.categories;
                // if(word.length > 1){
                //     for(let i = 0; categories_two.length > i; i++){
                //         for(let x = 0; word.length > x; x++){
                //             if(categories_two[i]['category'] == word[x]){
                //                 this.categories.push(categories_two[i]['category'])
                //             }
                //         }
                //     }
                // }
                // else if(word.length == 1){
                //     for(let i = 0; categories_two.length > i; i++){
                //         if(categories_two[i]['category'] == word){
                //             this.categories = categories_two[i]['category'];
                //             console.log(this.categories);
                //         }
                //     }
                // }
        },
        filterItems(arr, query) {
            return arr.filter((el) => el.toLowerCase().includes(query.toLowerCase()));
        },
        user_ban(id){
            axios.post(`/api/user_ban/${id}`)
                .then(res =>{
                    this.all_users();
                    // console.log(res);
                })
        },
        user_unban(id){
            axios.post(`/api/user_unban/${id}`)
                .then(res =>{
                    this.all_users();
                    // console.log(res);
                })
        },
        delete_category(id){
            axios.post(`/api/delete_category/${id}`)
                .then(res =>{
                    this.all_category();
                })
        },
        add_categoty(){
            axios.post('/api/add_category', {category: this.category})
                .then(res =>{
                    this.categories = res.data;
                    this.all_category();
                })
        },
        all_category(){
            axios.get('/api/category')
                .then(res =>{
                    this.categories = res.data;
                    this.category = '';
                    
                })
        },
        all_users(){
            axios.get('/api/all_users')
                .then(res =>{
                    this.users = res.data;
                })
        },
        logout() {
            axios.post("/logout").then((res) => {
                localStorage.removeItem("x_xsrf_token");
                localStorage.removeItem("name");
                localStorage.removeItem("surname");
                localStorage.removeItem("email");
                localStorage.removeItem("id");
                localStorage.removeItem("avatar");
                localStorage.removeItem("adress");
                localStorage.removeItem("number");
                this.$router.push("/");
                // console.log(res);
            });
        },
    },
};
</script>

<style scoped></style>
