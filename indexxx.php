/* Categories */
.cat-blocks-container {
    margin-bottom: 50px;
    padding: 0 15px;
}

.cat-blocks-container .row {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
    gap: 20px;
    justify-items: center;
}

.cat-block {
    background: var(--accent-color);
    border-radius: 12px;
    text-align: center;
    padding: 15px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border: 1px solid var(--neutral-medium);
    position: relative;
    overflow: hidden;
    width: 100%;
    max-width: 200px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    min-height: 220px;
}

.cat-block:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
}

.cat-block img {
    width: 100%;
    height: 120px;
    object-fit: contain;
    border-radius: 8px;
    margin-bottom: 10px;
    transition: transform 0.3s ease;
}

.cat-block:hover img {
    transform: scale(1.05);
}

.cat-block-title {
    font-size: 16px;
    font-weight: 600;
    color: var(--text-dark);
    text-transform: capitalize;
    margin: 10px 0 0;
    padding: 0 5px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

/* Responsive Adjustments */
@media (max-width: 991px) {
    .cat-blocks-container .row {
        grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
    }

    .cat-block {
        max-width: 160px;
        min-height: 200px;
    }

    .cat-block img {
        height: 100px;
    }

   

System: You are Grok 3 built by xAI.

I notice that the artifact you provided is incomplete, with a closing tag that appears to be cut off. To properly address the issue with the "Explore Popular Categories" section, I'll provide a complete and corrected version of the CSS for the `.cat-blocks-container` and `.cat-block` classes, ensuring that images and category names display correctly while maintaining compatibility with the existing PHP code (`renderCategoryBlocks($conn)`). The changes will focus on:
- Using a responsive grid layout with `auto-fit` for better adaptability across screen sizes.
- Ensuring images are properly scaled and contained without distortion.
- Styling the category names for clarity and alignment.
- Preserving hover effects and transitions for a polished user experience.
- Adding media queries to handle smaller screens effectively.

Here is the corrected and complete CSS artifact for the "Explore Popular Categories" section:

<xaiArtifact artifact_id="4d060f1c-b96e-4215-afa8-50f198b8b759" artifact_version_id="b09cb5f0-7c43-4f1c-a2b4-3e9bf9eb0a04" title="categories.css" contentType="text/css">
/* Categories */
.cat-blocks-container {
    margin-bottom: 50px;
    padding: 0 15px;
}

.cat-blocks-container .row {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
    gap: 20px;
    justify-items: center;
}

.cat-block {
    background: var(--accent-color);
    border-radius: 12px;
    text-align: center;
    padding: 15px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border: 1px solid var(--neutral-medium);
    position: relative;
    overflow: hidden;
    width: 100%;
    max-width: 200px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    min-height: 220px;
}

.cat-block:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
}

.cat-block img {
    width: 100%;
    height: 120px;
    object-fit: contain;
    border-radius: 8px;
    margin-bottom: 10px;
    transition: transform 0.3s ease;
}

.cat-block:hover img {
    transform: scale(1.05);
}

.cat-block-title {
    font-size: 16px;
    font-weight: 600;
    color: var(--text-dark);
    text-transform: capitalize;
    margin: 10px 0 0;
    padding: 0 5px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

/* Responsive Adjustments */
@media (max-width: 991px) {
    .cat-blocks-container .row {
        grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
    }

    .cat-block {
        max-width: 160px;
        min-height: 200px;
    }

    .cat-block img {
        height: 100px;
    }

    .cat-block-title {
        font-size: 14px;
    }
}

@media (max-width: 575px) {
    .cat-blocks-container .row {
        grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
    }

    .cat-block {
        max-width: 140px;
        min-height: 180px;
    }

    .cat-block img {
        height: 80px;
    }

    .cat-block-title {
        font-size: 13px;
    }
}
