<template>
  <div>
      <!-- <button @click="AuthProvider('github')" class="btn btn-theme btn-block">Login with Github</button> -->
     <!-- <a href="{{ url('login/facebook') }}" class="btn"
    			   style="line-height: .5rem; background:#3B5998; color:white; width: 100%; font-size:.9em;"><i class="fab fa-facebook-f"></i>
          Login med Facebook
      </a>

      

     <a href="{{ url('login/google') }}" class="btn"
			        style="line-height: .5rem; background:#DD4B39; color:white; width: 100%; font-size:.9em;"><i class="fab fa-google"></i>
          Login med Google
      </a>

      <button type="button" class="btn btn-theme btn-block"><a href="{{ url('login/facebook') }}"><i class="fab fa-facebook-f"></i>
          Login med Facebook </a>
      </button>

       <button type="button" class="btn btn-theme btn-block"><a href="{{ url('login/facebook') }}">><i class="fab fa-google"></i>
          Login med Google </a>
      </button> -->
      <button type="button" class="btn btn-theme btn-block"><i class="fab fa-facebook-f"></i>
          Login med Facebook    
    </button>

       <button type="button" class="btn btn-theme btn-block"><i class="fab fa-google"></i>
          Login med Google
      </button> 
  </div>
</template>

<script>
    export default {
        name: "SocialLogin",
        props: ['redirectUrl'],
        methods: {
            AuthProvider(provider) {
                var self = this
                this.$auth.authenticate(provider).then(response => {
                    self.SocialLogin(provider, response)
                }).catch(err => {
                    console.log({err: err})
                })
            },

            SocialLogin(provider, response) {
                this.$http.post('/sociallogin/' + provider, response).then(response => {
                    User.responseAfterLogin(response, this.redirectUrl);
                }).catch(err => {
                    console.log({err: err})
                })
            },
        }
    }
</script>

<style scoped>

</style>
