var Constants = {
  get_api_base_url: function () {
    if (location.hostname == "localhost") {
      return "http://localhost:8018/web-introduction/dentist-backend/";
    } else {
      return "https://walrus-app-dere7.ondigitalocean.app/dentist-backend/";
    }
  },
};