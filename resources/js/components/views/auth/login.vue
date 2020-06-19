<template>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Inicio de Sesión</div>
                <div class="card-body">
                    <form method="POST" action="/login" id="formLogin">
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Usuario:</label>
                            <div class="col-md-6">
                                <input id="username" v-model="username" type="text" class="form-control" name="username" value=""  autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Password:</label>
                            <div class="col-md-6">
                                <input id="password" v-model="password" type="password" class="form-control" name="password" required autocomplete="current-password">                           
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button @click="login()" type="button" class="btn btn-primary">
                                   Ingresar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    data() {
        return {
            username:'',
            password:'',
            user:'',
        }
    },
    methods:{
        login(){
            this.getUser();
            axios.post('login',{
                    username: this.username,
                    password: this.password,
            })
            .then((response)=>{
                if (response.status == 200) {
                     this.$store.commit('checkUser');
                    Swal.fire({
                        icon: 'success',
                        title: 'Ingreso Correcto!',
                        text:  'Bienvenido, '+ this.user.name,
                        timer: 1500
                    })
                }
            })
            .catch((e)=>{
                console.log(e.response)
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Los datos ingresados son incorrectos o no existen'
                })
            });
        },
        getUser(){
            axios.get('user',{
                params:{
                    username: this.username
                }
            })
            .then(({data})=>{
                // console.log(data);
                this.user = {
                    name: data.name
                }
            })
            .catch((e)=>{
                console.log(e.response)
            });
        }
    }
}
</script>

<style>

</style>