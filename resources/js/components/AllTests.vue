<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Tests</div>
          <div class="card-body">
            <div>I'm an mian tests page.</div>
            <div @click="getTests()">{{ tests[1].image }}</div>
            <img
              :src="tests[18].image"
              alt="img"
            />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data: function () {
    return {
      tests: "1",
    };
  },
  beforeMount() {
    this.getTests();
  },
  mounted() {
    console.log("Component mounted.");
  },
  methods: {
    getTests() {
      this.axios
        .get("/api/tests")
        .then((response) => {
          this.tests = response.data;
          console.log(response);
        })
        .catch((errors) => {
          console.log(errors);
        });
    },
  },
};
</script>