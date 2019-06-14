// Modules.
import SetupBusinessAccountConfirmationComponent from "./../components/modules/SetupBusiness/BusinessAccountConfirmationComponent.vue";
import SetupBusinessAvatarComponent from "./../components/modules/SetupBusiness/BusinessAvatarComponent.vue";
import SetupBusinessDescriptionComponent from "./../components/modules/SetupBusiness/BusinessDescriptionComponent.vue";
import SetupBusinessLocalizationComponent from "./../components/modules/SetupBusiness/BusinessLocalizationComponent.vue";
import SetupBusinessProfileCompletionComponent from "./../components/modules/SetupBusiness/BusinessProfileCompletionComponent.vue";
import SetupBusinessServicesComponent from "./../components/modules/SetupBusiness/BusinessServicesComponent.vue";
import SetupRegisterBusinessComponent from "./../components/modules/SetupBusiness/RegisterBusinessComponent.vue";

// Pages.
import AboutUsComponent from "./../components/pages/AboutUsComponent.vue";
import AdministrationComponent from "./../components/pages/AdministrationComponent.vue";
import BusinessesComponent from "./../components/pages/BusinessesComponent.vue";
import CookiePolicyComponent from "./../components/pages/CookiePolicyComponent.vue";
import HomeComponent from "./../components/pages/HomeComponent.vue";
import LoginComponent from "./../components/pages/LoginComponent.vue";
import PageNotFoundComponent from "./../components/pages/PageNotFoundComponent.vue";
import PricingsComponent from "./../components/pages/PricingsComponent.vue";
import PrivacyPolicyComponent from "./../components/pages/PrivacyPolicyComponent.vue";
import RegisterComponent from "./../components/pages/RegisterComponent.vue";
import ServiceRequestComponent from "./../components/pages/ServiceRequestComponent.vue";
import SingleBusinessComponent from "./../components/pages/SingleBusinessComponent.vue";
import SetupBusinessComponent from "./../components/pages/SetupBusinessComponent.vue";
import TermsOfUseComponent from "./../components/pages/TermsOfUseComponent.vue";

const routes = [
	{
		component: AboutUsComponent,
		name: "about-us",
		path: "/about-us"
	},
	{
		component: AdministrationComponent,
		meta: {
			requiresAuth: true,
		},
		name: "administration",
		path: "/administration"
	},
	{
		component: CookiePolicyComponent,
		name: "cookie-policy",
		path: "/cookie-policy"
	},
	{
		component: HomeComponent,
		name: "home",
		path: "/",
	},
	{
		component: LoginComponent,
		meta: {
			forbidsAuth: true,
		},
		name: "login",
		path: "/login",
	},
	{
		component: PricingsComponent,
		name: "pricings",
		path: "/pricings",
	},
	{
		component: PrivacyPolicyComponent,
		name: "privacy-policy",
		path: "/privacy-policy",
	},
	{
		component: RegisterComponent,
		meta: {
			forbidsAuth: true,
		},
		name: "register",
		path: "/register",
	},
	{
		component: ServiceRequestComponent,
		name: "service-request",
		path: "/projects/:id",
	},
	{
		component: TermsOfUseComponent,
		name: "terms-of-use",
		path: "/terms-of-use",
	},
	{
		component: SetupBusinessComponent,
		meta: {
			requiresAuth: true,
		},
		name: "setup-business",
		path: "/businesses/setup",
		children: [
			{
				component: SetupRegisterBusinessComponent,
				name: "register-business",
				path: "",
			},
			{
				component: SetupBusinessDescriptionComponent,
				name: "business-description",
				path: "description",
			},
			{
				component: SetupBusinessServicesComponent,
				name: "business-services",
				path: "services",
			},
			{
				component: SetupBusinessLocalizationComponent,
				name: "business-localization",
				path: "localization",
			},
			{
				component: SetupBusinessAvatarComponent,
				name: "business-avatar",
				path: "avatar",
			},
			{
				component: SetupBusinessAccountConfirmationComponent,
				name: "business-account-confirmation",
				path: "account-confirmation",
			},
			{
				component: SetupBusinessProfileCompletionComponent,
				name: "business-profile-completion",
				path: "profile-completion",
			},
		],
	},
	{
		component: SingleBusinessComponent,
		name: "single-business",
		path: "/businesses/:id",
	},
	{
		component: BusinessesComponent,
		name: "businesses",
		path: "/businesses",
	},
	{
		component: PageNotFoundComponent,
		name: "page-not-found",
		path: "*",
	},
];

export default routes;
