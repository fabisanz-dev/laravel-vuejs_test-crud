<template>
    <div class="container">
        <hr><div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Example Component</div>
                    <div class="panel-body">
                        Example list ajax http get
                        <ul>
                            <div v-for="item in list" v-bind:key="item.id">
                                <li>
                                    {{ item.title }}
                                </li>     
                            </div>
                        </ul>
                        <span>
                            total de Items: <b>{{ list.length }}</b>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
   import axios from 'axios';
    export default {
        mounted() {
            this.getUsers();
        },
        data(){
            return{
                list: [],
            }
        },
        methods:
        {
            getUsers()
            {
                axios.get('https://jsonplaceholder.typicode.com/posts')
                .then( (response) => 
                {
                    this.list = response.data;
                    console.log(this.list);
                })
                .catch( (error) => 
                {
                    console.log(error.data);
                });
            }
        }
    }
</script>
