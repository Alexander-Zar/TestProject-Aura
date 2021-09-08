<template>
  <div class="container">
    <div class="row d-flex justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            CreateTest
            <div>Hello user{{ user.id }}.</div>
          </div>
          <div class="card-body m-2 d-flex justify-content-center">
            <div>
              <form enctype="multipart/form-data">
                <input v-model="form.name" placeholder="Название теста" />
                <p>{{ form.name }}</p>

                <div>
                  <input
                    v-on:change="handleImageUpload()"
                    ref="testImage"
                    type="file"
                    accept=".png, .jpg, .jpeg"
                  />
                </div>

                <input v-model="newCategory" placeholder="Категории" />
                <button @click="addCategory(newCategory), newCategory=''" type="button">
                    +category
                </button>
                <p>{{ form.category }}</p>

                <div
                  v-for="(category, index) in existingCategories"
                  :key="category.id"
                >
                  <input
                    type="checkbox"
                    :id="category.name"
                    :value="category.name"
                    @click="addCategory(category.name)"
                  />
                  <label :for="category.name">{{category.name}}</label>
                </div>

                <input
                  v-model="form.time_for_solving"
                  type="number"
                  placeholder="Время в минутах"
                />
                <p>{{ form.time_for_solving }}</p>

                <div v-for="question in form.questions" :key="question.id">
                  Question {{ question.id + 1 }}
                  <div>
                    <input v-model="question.body" placeholder="Вопрос" />
                  </div>

                  <!-- <input v-model="question.type" type="checkbox" placeholder="Вопрос type" /> -->
                  <div v-for="type in questionTypes" :key="type.id">
                    <input
                      type="radio"
                      :id="type"
                      :value="type"
                      v-model="question.type"
                    />
                    <label :for="type">{{ type }}</label>
                  </div>
                  <!-- <input v-model="question.answers" placeholder="Answers" /> -->
                  <div
                    v-for="(answerVariant, index) in question.answers"
                    :key="answerVariant.id"
                  >
                    <input
                      v-model="question.answers[index]"
                      placeholder="Answers"
                    />
                    <button
                      @click="addAnswerVariant(question.id)"
                      type="button"
                    >
                      +
                    </button>
                    <button
                      @click="removeAnswerVariant(question.id, index)"
                      type="button"
                    >
                      -
                    </button>
                  </div>
                  <input
                    v-if="question.answers != ''"
                    v-model="question.right_answer"
                    placeholder="Right answer"
                  />
                </div>
                <button @click="addQuestion" type="button">Add Question</button>
                <div>
                  <button @click="createTest()" type="button">Create</button>
                </div>
              </form>
            </div>
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
      user: window.User,
      //   qeustions: 1,
      existingCategories: null,
      newCategory: "",
      formData: new FormData(),
      typeChecked: null,
      questionTypes: [
        "test with 1 answer",
        "test with few answers",
        "write one answer",
        "write few answers",
      ],

      form: {
        name: "",
        image: "",
        category: [],
        time_for_solving: "",
        questions: [
          { id: 0, body: "", type: "", answers: [""], right_answer: "" },
        ],
      },

      question: { id: 1, body: "", type: "", answers: [], right_answer: "" },
    };
  },
  beforeMount() {
    this.axios
      .get("/api/tests/create")
      .then((response) => {
        this.existingCategories = response.data;
        console.log(this.existingCategories);
      })
      .catch((err) => {
        console.log(err);
      });
  },
  mounted() {
    console.log("Component mounted.");
    console.log(typeof this.form.questions);
  },
  methods: {
    addQuestion() {
      this.form.questions.push({
        id: this.question.id++,
        body: "",
        type: "",
        answers: [""],
        right_answer: "",
      });
      console.log(this.form.questions);
    },
    addAnswerVariant(id) {
      console.log(this.form.category);
      this.form.questions[id].answers.push("");
    },
    removeAnswerVariant(id, index) {
      console.log(this.form.questions[id]);
      this.form.questions[id].answers.splice(index, 1);
    },
    createTest() {
      this.formData.append("name", this.form.name);
      this.formData.append("image", this.form.image);
      let category = JSON.stringify(this.form.category);
      this.formData.append("category", category);
      this.formData.append("time_for_solving", this.form.time_for_solving);
      let questions = JSON.stringify(this.form.questions);
      this.formData.append("questions", questions);
      console.log(this.formData);
      console.log(this.form);
      this.axios
        .post("/api/tests", this.formData)
        .then((response) => {
          console.log(response.data);
        })
        .catch((err) => {
          console.log(err);
        });
    },
    addCategory(value){
        this.form.category.push(value)
    },
    handleImageUpload() {
      this.form.image = this.$refs.testImage.files[0];
    },
  },
};
</script>

<style scoped>
</style>