<template>
    <div>
        <header-component></header-component>

        <content-component>
            <!-- Cookie Policy card-->
            <div class="container">
                <div class="card terms-card">
                    <div class="card-header">
                        <h2>Cookie Policy</h2>
                    </div>
                    <div class="card-body card-terms-body">
                        <h3 class="card-title">This is our Cookie Policy, last updated on 1 December, 2018. </h3>
                        <hr>

                        <h4>
                            Cookies on this website
                        </h4>
                        <p class="card-text">We use cookies and other data intelligence and analysis technologies on this website for various purposes. In most cases, we will need your consent in order to use cookies on this website. The exception is where the cookie is essential
                            in order for us to provide you with a service you have requested (eg to enable you to purchase credits). Cookies are small pieces of information which are issued to your device when you visit a website or application and which store
                            and sometimes track information about your use of the Site. A number of cookies we use last only for the duration of your session and expire when you close your browser. Other cookies are used to remember you when you return to the
                            Site and will last for longer. There is a notice on our home page which describes how we use cookies and which also provides a link to our website privacy policy. If you use this website after this notification has been displayed to
                            you, we will assume that you consent to our use of cookies for the purposes described in this website cookie policy and our website privacy policy.</p>

                        <h4>
                            How we use cookies on our platform:
                        </h4>
                        <p class="card-text">
                            <ul>
                                <li>
                                    remember that you have visited us before; this means we can identify the number of unique visitors we receive. This allows us to make sure we have enough capacity for the number of users that we get;

                                </li>
                                <li>
                                    customise elements of the promotional layout and/or content of the pages of the Site;

                                </li>
                                <li>
                                    collect anonymous statistical information about how you use the Site (including how long you spend on the Site) and where you have come to the Site from, so that we can improve the Site and learn which parts of the Site are most popular with visitors;
                                </li>
                                <li>
                                    and gather information about the pages on the Site that you visit, and also other information about other websites that you visit, so as to place you in a "market segment". This information is only collected by reference to the IP address that you are
                                    using, but does include information about the State, LGA and city you are in, together with the name of your internet service provider. This information is then used to localise the service providers most suitable to you. For
                                    more information about this type of interest based advertising, and about how to turn this feature off please visit: <b>cookie link</b>
                                </li>
                            </ul>
                        </p>

                        <p class="card-text">Most web browsers automatically accept cookies but, if you prefer, you can change your browser to prevent that or to notify you each time a cookie is set. You can also learn more about cookies by visiting www.allaboutcookies.org which
                            includes additional useful information on cookies and how to block cookies using different types of browser. Please note, however, that by blocking or deleting cookies used on the Site, you may not be able to take full advantage of
                            the Site. In addition to cookies, tracking Gifs may be set by us or third parties in respect of your use of the Site. Tracking Gifs are small image files within the content of the Site or the body of our newsletters so we or third
                            parties can understand which parts of the Site are visited and whether particular content is of interest. </p>
                    </div>
                </div>
            </div>
        </content-component>

        <footer-component></footer-component>

        <link rel="stylesheet" href="css/StyleSheet.css">
    </div>
</template>

<script>
import ContentComponent from "./../modules/ContentComponent.vue";
import FooterComponent from "./../modules/FooterComponent.vue";
import HeaderComponent from "./../modules/HeaderComponent.vue";

export default {
	components: {
		ContentComponent,
		FooterComponent,
		HeaderComponent,
	},
};
</script>