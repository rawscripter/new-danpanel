<template>
  <footer class="container-fluid w3-left text-white footer-section">
    <div class="row footer-row-contianer">
      <div class="col-12">
        <div class="row">
          <div class="col-md-3 FooterSectionGap">
            <h4>DanPanel ApS</h4>
            <p>
              Marielundvej 20, <br />
              2730 Herlev
            </p>
            <p class="">CVR-Nummer: 38362925</p>
          </div>
          <div class="col-md-3 FooterSectionGap">
            <h4>Kontakt</h4>
            <span class="" style="">Tlf.: +45 32 22 32 03</span><br />
            <span class="">Mail: hej@danpanel.dk</span><br />
            <span class="">Man-Fre fra kl. 09:00 - 15:00 </span><br />
            <span class="">Vi svarer inden for 24 timer alle arbejdsdage </span>
          </div>
          <div class="col-md-3 FooterSectionGap">
            <h4>
              <span class="text-white footer-hover h4">Om os </span>
            </h4>

            <p v-for="page in pages" :key="page.id">
              <router-link
                :to="{ name: 'page', params: { page: page.slug } }"
                style="color: white"
                >{{ page.title }}
              </router-link>
            </p>
          </div>
          <div class="col-md-3 FooterSectionGap">
            <p class="">
              <a
                class="text-white h6 footer-hover mb-3"
                href="https://certifikat.emaerket.dk/danpanel.dk?fbclid=IwAR2VDaxwELCwtxtC_xBNCEEf-V1JRRzknI1VgWITjoM3vFm7Cf1MZI_Xrh0"
                target="_blank"
              >
                <h4>E-mærket certifikat</h4></a
              >
            </p>
            <p>
              <a
                class="footer-hover"
                href="https://certifikat.emaerket.dk/danpanel.dk?fbclid=IwAR2VDaxwELCwtxtC_xBNCEEf-V1JRRzknI1VgWITjoM3vFm7Cf1MZI_Xrh0"
                target="_blank"
              >
                <img
                  src="/images/icons/e-market03.png"
                  width="150px"
                  alt="e-mærket"
                />
              </a>
            </p>
            <p>
              <img
                src="/images/icons/Sitemap-footer-betalingsmuligheder.png"
                width="220px"
                height="40px;"
                alt="betalingsmuligheder"
              />
            </p>
          </div>
        </div>
      </div>
    </div>
    <div class="row footer-row-contianer" style="">
      <div class="col-md-4">
        <a
          href="#main_body_area"
          class="w3-button w3-blue w3-round w3-center footer-arrow-up"
          ><i
            class="w3-round fa fa-arrow-up"
            style="color: white"
            @click="backToTop"
          ></i
        ></a>
      </div>
      <div class="col-md-4 footer-align-items-center">
        <a
          class="m-2"
          href="https://www.facebook.com/DanPanelDK"
          target="_blank"
        >
          <i
            class="fab fa-facebook-square fa-3x w3-hover-opacity"
            style="color: white"
          ></i>
        </a>
        <a
          class="m-2"
          href="https://www.linkedin.com/company/danpanel/"
          target="_blank"
        >
          <i
            class="fab fa-linkedin fa-3x w3-hover-opacity"
            style="color: white"
          ></i
        ></a>
        <a
          class="m-2"
          href="https://www.instagram.com/danpanel.dk/"
          target="_blank"
        >
          <i
            class="fab fa-instagram fa-3x w3-hover-opacity"
            style="color: white"
          ></i
        ></a>
      </div>
      <div
        class="col-md-4 footer-arrow-up-mobile"
        style="text-align: center; justify-content: center"
      >
        <a href="#" class="w3-button w3-blue w3-round w3-center text-white"
          ><i class="w3-round fa fa-arrow-up"></i
        ></a>
      </div>
    </div>
    <div class="row footer-align-items-center">
      <div class="col-md-12 copyright-text1">
        <p style="text-align: center">
          Copyright &copy; 2022 DanPanel Aps. All Right Reserved.
        </p>
      </div>
    </div>
  </footer>
</template>

<script>
export default {
  name: "SiteFooter",
  methods: {
    backToTop() {
      return window.scrollTo(0, 0);
    },

    getPages() {
      axios.get(`${APP_URL}/api/get/pages?bottom=1`).then((res) => {
        this.pages = res.data.pages;
        this.isLoading = false;
      });
    },
  },
  data() {
    return {
      pages: [],
      isLoading: true,
    };
  },
  mounted() {
    this.getPages();
  },
};
</script>

<style scoped>
</style>
