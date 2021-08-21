<template>
  <div>
    <section v-show="!showContent" style="margin-top: 200px">
      <div class="row">
        <div class="col-lg-12 my-3">
          <div class="pull-right">
            <p class="title is-1" style="text-align: center">
              Edite issue details
            </p>

            <hr />
          </div>
        </div>
      </div>

      <div
        class="shadow-lg p-3 mb-5 bg-body rounded"
        style="width: 400px; margin-left: 570px; padding-left: 30px"
      >
        <div style="width: 300px; margin-left: 30px">
          <b-field label="Name">
            <b-input
              v-model="editecat.Title"
              type="text"
              value="john@"
              maxlength="30"
              required
            >
            </b-input>
          </b-field>

          <b-field label="Message">
            <b-input
              v-model="editecat.Body"
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
              :loading="updateStatus"
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
            <p class="title is-1">All Issues</p>
            <hr />
          </div>
        </div>
      </div>
      <div id="products" class="row view-group">
        <div
          v-for="issue in issues"
          :key="issue.id"
          class="item col-xs-4 col-lg-4"
          style="margin-bottom: 20px; box-shadow: #1a202c"
        >
          <div class="card" style="width: 400px; background-color: #c0c0c0">
            <header class="card-header" style="text-align: center">
              <p class="subtitle is-4" style="color: black">
                <b>{{ issue.Title }}</b>
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
                {{ issue.Body }}
                <br />
                <br />
                <time class="float-left" datetime="2016-1-1">
                  {{ issue.SLUG }}
                </time>
                <b
                  ><time class="float-right" datetime="2016-1-1">
                    User ID :{{ issue.UUID }}
                  </time></b
                >
              </div>
            </div>
            <footer class="card-footer">
              <button
                class="card-footer-item"
                style="color: black; border: none; background: white"
                @click="viewComment(issue.id)"
              >
                View
              </button>
              <div class="verticalLine"></div>
              <button
                class="card-footer-item"
                style="border: none; background: white"
                @click="editeIssue(issue.id)"
              >
                Edit
              </button>
              <div class="verticalLine"></div>
              <button
                class="card-footer-item"
                style="color: red; border: none; background: white"
                @click="confirmCustomDelete(issue.id)"
              >
                Delete
              </button>
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
      issues: [],
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

      showContent: true,
      updateStatus: false,
    }
  },

  async mounted() {
    this.mountains = await this.fetchAllissue()
    this.issues = this.mountains.data.data
    /* eslint-disable no-console */
    console.log(this.mountains.data.data)
  },

  methods: {
    async fetchAllissue() {
      return await this.$axios.get('/issue')
    },

    confirmCustomDelete(issueID) {
      try {
        this.$buefy.dialog.confirm({
          title: 'Deleting account',
          message:
            'Are you sure you want to <b>delete</b> this category? This action cannot be undone.',
          confirmText: 'Delete Account',
          type: 'is-danger',
          hasIcon: true,
          onConfirm: async () => {
            await this.$axios.delete('/issue/' + issueID)
            const postion = await this.issues.findIndex((x) => x.id === issueID)
            this.issues.splice(postion, 1)
            this.$buefy.toast.open('Account deleted!')
          },
        })
      } catch {
        this.$buefy.toast.open('Something went wrong!')
      }
    },

    async editeIssue(issueID) {
      try {
        this.editecat = (await this.$axios.get('/issue/' + issueID)).data.data
        /* eslint-disable no-console */
        console.log(this.editecat)
        this.showContent = false
      } catch {}
    },

    async updateCategory(issueID) {
      try {
        this.updateStatus = true
        this.$buefy.toast.open(`Your data is sending...`)
        await this.$axios.put('/issue/' + issueID, this.editecat)
        this.$buefy.toast.open(`Update success!`)
        this.updateStatus = false
      } catch (err) {
        this.$buefy.toast.open(`<b>Something went wrong..</b>  ${err}`)
        this.updateStatus = true
      }
    },

    cancelRequest() {
      this.$router.go()
    },

    viewComment(issueID) {
      this.$router.push('/comments/' + issueID)
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
