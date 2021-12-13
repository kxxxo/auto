import {Link, NavLink} from "react-router-dom";

function Prices() {
    return (
        <section className="u-align-center u-clearfix u-grey-5 u-section-2" id="sec-3dfd">
            <div className="u-clearfix u-sheet u-sheet-1">
                <div className="u-clearfix u-gutter-20 u-layout-wrap u-layout-wrap-1">
                    <div className="u-layout">
                        <div className="u-layout-row">
                            <div
                                className="u-align-center u-border-no-bottom u-border-no-left u-border-no-right u-border-no-top u-container-style u-layout-cell u-left-cell u-size-15 u-size-30-md u-white u-layout-cell-1">
                                <div className="u-container-layout u-valign-top u-container-layout-1">
                                    <h5 className="u-text u-text-1">Старт</h5>
                                    <h3 className="u-text u-text-2">$ 0.00</h3>
                                    <p className="u-text u-text-3">1 Авто<br/>5 Социальных сетей<br/>
                                        <br/>
                                        <br/>
                                    </p>
                                    <NavLink to="/authorization" className="u-btn u-btn-round u-button-style u-hover-palette-2-base u-palette-1-base u-radius-50 u-btn-1">
                                        Начать сейчас
                                    </NavLink>
                                </div>
                            </div>
                            <div
                                className="u-align-center u-container-style u-layout-cell u-size-15 u-size-30-md u-white u-layout-cell-2">
                                <div className="u-container-layout u-valign-top u-container-layout-2">
                                    <h5 className="u-text u-text-4">Прогрев</h5>
                                    <h3 className="u-text u-text-5">$ 49.99</h3>
                                    <p className="u-text u-text-6">5 Авто<br/>10 Социальных сетей<br/>
                                        <br/>
                                        <br/>
                                    </p>
                                    <a href="javascript:"
                                       className="disabled u-btn u-btn-round u-button-style u-hover-palette-2-base u-palette-1-base u-radius-50 u-btn-2">Купить
                                        сейчас</a>
                                </div>
                            </div>
                            <div
                                className="u-align-center u-border-no-bottom u-border-no-left u-border-no-right u-border-no-top u-container-style u-layout-cell u-size-15 u-size-30-md u-white u-layout-cell-3">
                                <div className="u-container-layout u-valign-top u-container-layout-3">
                                    <h5 className="u-text u-text-7">Разгон</h5>
                                    <h3 className="u-text u-text-8">$ 79.99</h3>
                                    <p className="u-text u-text-9">10 Авто<br/>20 Социальных сетей<br/>Персональный
                                        QR
                                        код<br/>
                                        <br/>
                                    </p>
                                    <a href="javascript:"
                                       className="disabled u-btn u-btn-round u-button-style u-hover-palette-2-base u-palette-1-base u-radius-50 u-btn-3"> Купить
                                        сейчас</a>
                                </div>
                            </div>
                            <div
                                className="u-align-center u-border-no-bottom u-border-no-left u-border-no-right u-border-no-top u-container-style u-layout-cell u-right-cell u-size-15 u-size-30-md u-white u-layout-cell-4">
                                <div className="u-container-layout u-valign-top u-container-layout-4">
                                    <h5 className="u-text u-text-10">Эксперт</h5>
                                    <h3 className="u-text u-text-11">$ 129.99</h3>
                                    <p className="u-text u-text-12">Безлимитное кол-во авто<br/>Безлимитное кол-во
                                        соц. сетей<br/>Персональный
                                        QR код
                                    </p>
                                    <a href="javascript:"
                                       className="disabled u-btn u-btn-round u-button-style u-hover-palette-2-base u-palette-1-base u-radius-50 u-btn-4"> Купить
                                        сейчас</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    )
}

export default Prices;