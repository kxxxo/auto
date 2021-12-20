import './components/nicepage.css';

import React, {Fragment} from "react";
import {
    BrowserRouter as Router,
    Switch,
    Route
} from "react-router-dom";
import Header from './components/header';
import Footer from './components/footer';
import Index from "./pages/index";
import Authorization from "./pages/authorization"
import Show from "./pages/show";
import CheckToken from "./pages/check-token";
import ProfileConfig from "./pages/profile-config";
import FooterWithAuthorization from "./components/footer/footer-with-authorization";

/**
 * @returns {JSX.Element}
 * @constructor
 */
function App() {
    return (
        <Fragment>
            {/*<Helmet>*/}
            {/*    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>*/}
            {/*    <meta charSet="utf-8"/>*/}
            {/*    <meta name="keywords" content="Мешает авто?"/>*/}
            {/*    <meta name="description" content="QR код мешает авто"/>*/}
            {/*    <meta name="page_type" content="np-template-header-footer-from-plugin"/>*/}
            {/*    <title>Главная</title>*/}
            {/*    <meta name="generator" content="Nicepage 3.21.3, nicepage.com"/>*/}
            {/*    <link id="u-theme-google-font" rel="stylesheet"*/}
            {/*          href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i"/>*/}

            {/*    <meta name="theme-color" content="#478ac9"/>*/}
            {/*    <meta property="og:title" content="Главная"/>*/}
            {/*    <meta property="og:description" content="QR код мешает авто"/>*/}
            {/*    <meta property="og:type" content="website"/>*/}
            {/*</Helmet>*/}
            <Header/>
            <Router>
                <Switch>
                    <Route path="/authorization/:token">
                        <CheckToken/>
                        <Footer/>
                    </Route>
                    <Route path="/authorization">
                        <Authorization/>
                        <Footer/>
                    </Route>
                    <Route path="/show/:id">
                        <Show/>
                        <FooterWithAuthorization/>
                    </Route>
                    <Route path="/profile-config">
                        <ProfileConfig/>
                        <Footer/>
                    </Route>
                    <Route path="/">
                        <Index/>
                        <Footer/>
                    </Route>
                </Switch>
            </Router>
        </Fragment>
    );
}

export default App;
