
function Header() {
    return (
        <header className="u-clearfix u-header u-header">
            <div className="u-clearfix u-sheet u-sheet-1">
                <p className="u-text u-text-default u-text-1">{process.env.REACT_APP_PROJECT_NAME}</p>
            </div>
        </header>
    )
}

export default Header;
