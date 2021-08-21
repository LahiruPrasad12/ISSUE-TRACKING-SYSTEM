<template>
  <div>
    <section v-show="!showContent" style="margin-top: 200px">
      <div class="row">
        <div class="col-lg-12 my-3">
          <div class="pull-right">
            <p class="title is-1" style="text-align: center">
              Edite category details
            </p>

            <hr />
          </div>
        </div>
      </div>

      <div
        class="shadow-lg p-3 mb-5 bg-body rounded"
        style="width: 400px; margin-left: 550px; padding-left: 30px"
      >
        <div style="width: 300px; margin-left: 30px">
          <b-field label="Name">
            <b-input
              v-model="editecat.name"
              type="text"
              value="john@"
              maxlength="30"
              required
            >
            </b-input>
          </b-field>

          <b-field label="Message">
            <b-input
              v-model="editecat.description"
              maxlength="200"
              type="textarea"
              required
            ></b-input>
          </b-field>

          <div class="buttons" style="margin-left: 90px">
            <b-button type="is-success" outlined @click="cancelRequest()"
              >Cancel</b-button
            >
            <b-button
              type="is-danger"
              outlined
              :loading="editSubCatStatus"
              @click="updateCategory(editecat.id)"
              >Update data</b-button
            >
          </div>
        </div>
      </div>
    </section>

    <!--All category retrieve here-->
    <div v-show="showContent" class="container" style="margin-top: 200px">
      <div class="row">
        <div class="col-lg-12 my-3">
          <div class="pull-right">
            <p class="title is-1">All Categories</p>
            <hr />
          </div>
        </div>
      </div>
      <div id="products" class="row view-group">
        <div
          v-for="categories in categories"
          :key="categories.id"
          class="item col-xs-4 col-lg-4"
          style="margin-bottom: 20px; box-shadow: #1a202c"
        >
          <div class="card" style="width: 400px; background-color: #c0c0c0">
            <header class="card-header" style="text-align: center">
              <p class="subtitle is-4" style="color: black">
                <b>{{ categories.name }}</b>
              </p>
              <hr />
              <button class="card-header-icon" aria-label="more options">
                <span class="icon">
                  <i class="fas fa-angle-down" aria-hidden="true"></i>
                </span>
              </button>
            </header>
            <div class="card-content" style="color: black">
              <div class="content">
                {{ categories.description }}
                <br />
                <time datetime="2016-1-1">11:09 PM - 1 Jan 2016</time>
              </div>
            </div>
            <footer class="card-footer">
              <div class="verticalLine"></div>
              <b-button
                class="card-footer-item"
                style="color: black; border: none; background: white"
                @click="viewSubCategory(categories.id)"
              >
                View
              </b-button>

              <div class="verticalLine"></div>
              <b-button
                class="card-footer-item"
                type="is-primary"
                style="color: black; border: none; background: white"
                @click="editeteSubCat(categories.id)"
              >
                Edit
              </b-button>

              <div class="verticalLine"></div>
              <b-button
                style="color: red; border: none; background: white"
                type="is-danger"
                outlined
                class="card-footer-item"
                @click="confirmCustomDelete(categories.id)"
              >
                Delete
              </b-button>
            </footer>
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
      mountains: [],
      categories: [],
      deletCate: [],
      editecat: {
        id: 0,
        name: '',
        description: '',
      },
      name: 'lahiru',
      message: null,
      state: false,
      primarState: false,

      editSubCatStatus: false,
      showContent: true,
      worningAlert: false,
    }
  },
  async mounted() {
    this.mountains = await this.fetchAllCategories()
    this.categories = this.mountains.data.data
  },

  methods: {
    async fetchAllCategories() {
      return await this.$axios.get('/category')
    },

    addData() {
      alert(this.name)
    },

    confirmCustomDelete(categoryID) {
      try {
        this.$buefy.dialog.confirm({
          title: 'Deleting account',
          message:
            'Are you sure you want to <b>delete</b> this category? This action cannot be undone.',
          confirmText: 'Delete Account',
          type: 'is-danger',
          hasIcon: true,
          onConfirm: async () => {
            await this.$axios.delete('/category/' + categoryID)
            const postion = await this.categories.findIndex(
              (x) => x.id === categoryID
            )
            this.categories.splice(postion, 1)
            this.$buefy.toast.open('Account deleted!')
          },
        })
      } catch {
        this.$buefy.toast.open('Something went wrong!')
      }
    },

    viewSubCategory(subID) {
      this.$router.push('/categories/' + subID)
    },

    async editeteSubCat(subCatId) {
      try {
        this.editecat = (
          await this.$axios.get('/category/' + subCatId)
        ).data.data
        /* eslint-disable no-console */
        console.log(this.editecat)
        if (this.editecat.length === 0) {
          alert('something going else')
        } else {
          this.showContent = false
        }
      } catch {}
    },

    async updateCategory(subCatID) {
      this.editSubCatStatus = true
      this.$buefy.toast.open(`Your data is sending...`)
      await this.$axios
        .put('/category/' + subCatID, this.editecat)
        .then((res) => {
          if (res.status === 200) {
            this.$buefy.toast.open(`Update success!`)
          } else {
            this.$buefy.toast.open(`Something went wrong... plz try again!`)
          }
        })
      this.editSubCatStatus = false
    },

    cancelRequest() {
      this.$router.go()
    },
  },
}
</script>

<style scoped>
.verticalLine {
  border-left: 4px solid #4b42f5;
  height: fit-content;
}
</style>
