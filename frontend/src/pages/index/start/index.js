import {NavLink} from "react-router-dom";

function Start() {
    return (
        <section className="u-align-center u-clearfix u-image u-shading u-section-3"  data-image-width="1280"
                 data-image-height="800" id="sec-58cb">
            <div className="u-align-center u-clearfix u-sheet u-valign-middle u-sheet-1">
                <h2 className="u-text u-text-default u-text-1">Начать прямо сейчас</h2>
                <p className="u-text u-text-2">Получите свой первый QR код уже сейчас, бесплатно!</p>
                <NavLink to="/authorization" className="u-btn u-button-style u-btn-1">Начать</NavLink>
            </div>
        </section>
    )
}

export default Start;