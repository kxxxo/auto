function Footer() {
    return (
        <footer className="u-clearfix u-footer u-grey-80" id="sec-3edd">
            <div className="u-clearfix u-sheet u-valign-middle u-sheet-1">
                <p className="u-small-text u-text u-text-variant u-text-1" style={{
                    margin: '49px auto',
                    letterSpacing: '1px',
                    fontWeight: 700,
                    textTransform: 'uppercase'
                }}>
                    <a href={"mailto:kxxo.ea@gmail.com?subject=" + process.env.REACT_APP_DOMAIN}
                       className="u-border-1 u-border-active-palette-2-base u-border-hover-palette-1-base u-btn u-button-link u-button-style u-none u-text-palette-1-base u-btn-1">Обратная
                        связь</a>
                </p>
            </div>
        </footer>
    )
}

export default Footer;
