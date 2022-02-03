<template>
<div>
  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark  fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#">Blog</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active" v-if="isAdmin">
            <router-link class="nav-link"  :to="'/admin'">admin
              <span class="sr-only">(current)</span>
            </router-link>
          </li>
                    <li class="nav-item active">
            <router-link class="nav-link" to="/">Home
              <span class="sr-only">(current)</span>
            </router-link>
          </li>

          <li  class="nav-item register-btn reg-login-btn" data-toggle="modal" data-target="#register-modal" v-if="!isLogged">
            <a class="btn btn-warning nav-link" href="" data-toggle="modal" data-target="#register-modal">Register</a>
          </li>

           <li class="nav-item register-btn reg-login-btn" data-toggle="modal" data-target="#login-modal" v-if="!isLogged">
            <a class="btn btn-warning nav-link" href="" data-toggle="modal" data-target="#login-modal">login</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- switch between components -->
<router-view></router-view>
</div>
</template>

<script>
   export default {
  created(){
      this.updateToken()
      this.setUser();
  },
//   components:{
//       Login,
//   },
  methods:{
     updateToken(){
       let token =JSON.parse(localStorage.getItem('userToken'));
       this.$store.commit('setUserToken',token)
     },
     setUser(){
               if(this.isLogged){
                  axios.get('http://localhost:8000/api/user')
                        .then(res => {
                            this.$store.commit('setUser', res.data.user)
                        })
               }
     },
  },
  computed:{
      isLogged(){
          return this.$store.getters.isLogged
      },
      isAdmin(){
          return this.$store.getters.isAdmin
      }
  }
}
</script>
