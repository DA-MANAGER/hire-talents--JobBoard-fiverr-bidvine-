<template>
    <footer id="footer" class="site-footer bg-white">
        <div>
            <div class="container">
                <div class="row py-4">
                    <div class="col-md-3">
                        <h5 class="font-weight-bold">Company</h5>

                        <ul class="navigation">
                            <li class="list-item">
                                <router-link :to="{name: 'about-us'}">About us</router-link>
                            </li>

                            <li class="list-item">
                                <router-link :to="{name: 'pricings'}">Pricings</router-link>
                            </li>

                            <li class="list-item">
                                <router-link :to="{name: 'terms-of-use'}">Terms of use</router-link>
                            </li>
                            
                            <li class="list-item">
                                <a href="#">Blog</a>
                            </li>
                            
                            <li class="list-item">
                                <a href="#">Help Centre</a>
                            </li>
                        </ul>
                    </div>

                    <div class="col-md-3">
                        <h5 class="font-weight-bold">Customers</h5>

                        <ul class="navigation">
                            <li class="list-item">
                                <a href="#">How {{ $appName }} Works</a>
                            </li>

                            <li class="list-item">
                                <a href="#">Hire Smart</a>
                            </li>
                            
                            <li class="list-item">
                                <a href="#">Services Near Me</a>
                            </li>
                            
                            <li class="list-item">
                                <a href="#">Articles &amp; Advice</a>
                            </li>

                            <li class="list-item">
                                <a href="#">Price Guides</a>
                            </li>
                        </ul>
                    </div>
                    
                    <div class="col-md-3">
                        <h5 class="font-weight-bold">Professionals</h5>

                        <ul class="navigation">
                            <li class="list-item">
                                <a href="#">Join {{ $appName }}</a>
                            </li>

                            <li class="list-item">
                                <a href="#">Pro Desk</a>
                            </li>
                            
                            <li class="list-item">
                                <a href="#">Success Stories</a>
                            </li>
                        </ul>
                    </div>

                    <div class="col-md-3">
                        <h5 class="font-weight-bold">Support</h5>

                        <ul class="navigation">
                            <li class="list-item">
                                <a href="#">Live Chat</a>
                            </li>

                            <li class="list-item">
                                <a href="#">Help Centre</a>
                            </li>

                            <li class="list-item">
                                <a href="#">Phone us</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="border-top py-3">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <p class="mb-0 text-muted">
                            &copy; {{ $appName }} LTD. 2018
                            |
                            <router-link :to="{name: 'cookie-policy'}">Cookie</router-link>
                            |
                            <router-link :to="{name: 'privacy-policy'}">Privacy</router-link>
                        </p>
                    </div>

                    <div class="col-md-6">
                        <div class="text-right">
                            <ul class="social-links">
                                <li class="list-item">
                                    <a href="#">
                                        <i class="fab fa-facebook-f text-dark"></i>
                                    </a>
                                </li>

                                <li class="list-item">
                                    <a href="#">
                                        <i class="fab fa-twitter text-dark"></i>
                                    </a>
                                </li>
                                
                                <li class="list-item">
                                    <a href="#">
                                        <i class="fab fa-google-plus text-dark"></i>
                                    </a>
                                </li>
                                
                                <li class="list-item">
                                    <a href="#">
                                        <i class="fab fa-instagram text-dark"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</template>

<script>
    export default {
        //   
    };
</script>

<style lang="scss" scoped>
    .navigation {
        margin: 20px 0;
        padding: 0;

        .list-item {
            list-style-type: none;
        }
    }

    .social-links {
        margin: 0;

        .list-item {
            display: inline-block;
            font-size: 18px;
            list-style-type: none;

            &:not(:last-child) {
                margin-right: 10px;
            }
        }
    }
</style>
