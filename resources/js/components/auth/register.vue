<template>
  <div class="row justify-content-center">
    <div class="col-xl-10 col-lg-12 col-md-9">
      <div class="card shadow-sm my-5">
        <div class="card-body p-0">
          <div class="row">
            <div class="col-lg-12">
              <div class="login-form">
                <div class="text-center">
                  <h1 class="h4 text-gray-900 mb-4">Register</h1>
                </div>
                <form class="user" @submit.prevent="signup">
                  <div class="form-group">
                    <input
                      v-model="form.name"
                      type="text"
                      class="form-control"
                      id="exampleInputFirstName"
                      placeholder="Enter Your Full Name"
                    />
                  </div>

                  <div class="form-group">
                    <input
                      type="email"
                      v-model="form.email"
                      class="form-control"
                      id="exampleInputEmail"
                      aria-describedby="emailHelp"
                      placeholder="Enter Your Email Address"
                    />
                  </div>
                  <div class="form-group">
                    <input
                      type="password"
                      v-model="form.password"
                      class="form-control"
                      id="exampleInputPassword"
                      placeholder="Password"
                    />
                  </div>
                  <div class="form-group">
                    <input
                      type="password"
                      v-model="form.password_confirmation"
                      class="form-control"
                      id="exampleInputPasswordRepeat"
                      placeholder="Confirm Password"
                    />
                  </div>
                  <div class="form-group">
                    <label for="exampleFormControlSelect1">Role:</label>
                    <select v-model="form.role" class="custom-select">
                      <option value="PM">PM</option>
                      <option value="QC">QC</option>
                      <option value="Contractor">Contractor</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block text-white">
                      Register
                    </button>
                  </div>
                  <hr />
                </form>
                <hr />
                <div class="text-center">
                  <router-link class="font-weight-bold small" to="/"
                    >Already have an account?</router-link
                  >
                </div>
                <div class="text-center"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  created() {
    if (!User.loggedIn()) {
            this.$router.push({
                name: '/'
            })
        }
  },
  data() {
    return {
      form: {
        email: null,
        password: null,
        name: null,
        role: null,
        password_confirmation: null,
      },
    };
  },
  methods: {
    signup() {
      axios.post("/api/auth/signup", this.form).then((res) => {
        User.responseAfterLogin(res);

        Toast.fire({
          icon: "success",
          title: "Signed in successfully",
        });

        this.$router.push({ name: "home" });
      });
    },
  },
};
</script>

<style>
</style>
